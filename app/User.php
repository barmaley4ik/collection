<?php

namespace App;

use League\Glide\Server;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    const ROLE_ADMIN = '1';
    const ROLE_SMM = '2';
    const ROLE_MARKETING = '3';

    use SoftDeletes, Authenticatable, Authorizable;

/*     public function account()
    {
        return $this->belongsTo(Account::class);
    } */
        
    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function photoUrl(array $attributes)
    {
        if ($this->photo_path) {
            return URL::to(App::make(Server::class)->fromPath($this->photo_path, $attributes));
        }
    }

    public function isAdmin()
    {
        return $this->owner === self::ROLE_ADMIN;
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('last_name')->orderBy('first_name');
    }

    public function scopeWhereRole($query, $role)
    {
        switch ($role) {
            case 'Admin': return $query->where('owner', self::ROLE_ADMIN);
            case 'SMM': return $query->where('owner', self::ROLE_SMM);
            case 'Marketing': return $query->where('owner', self::ROLE_MARKETING);
        }
    }

    public function scopeWhoSend($query)
    {

     return $query->whereRole(self::ROLE_ADMIN)
        ->whereRole(self::ROLE_MARKETING)
        ->whereNotNull('telegram_user_id');

    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%'.$search.'%')
                    ->orWhere('last_name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });
        })->when($filters['role'] ?? null, function ($query, $role) {
            $query->whereRole($role);
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }

    public function routeNotificationForTelegram()
    {
        return $this->telegram_user_id;
    }    
}
