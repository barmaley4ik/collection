<?php

namespace App\Front;
use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;

class Member extends Model
{
    use HasTranslations;

    public $translatable = [
        'name',
        'adress',
        'title',
        'description',
        'studio',
        'city',
    ];
    
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }
    
    // get next member
    public function next()
    {
        return Member
        ::where('id', '>', $this->id)
        ->where('festival_id', '=', $this->festival_id)
        ->orderBy('id','asc')->first();
    }

    // get previous  member
    public function previous()
    {
        return Member
        ::where('id', '<', $this->id)
        ->where('festival_id', '=', $this->festival_id)
        ->orderBy('id','desc')
        ->first();
    }    
    
    public function getRouteKeyName()
    {
        return 'slug';
    }  
}
