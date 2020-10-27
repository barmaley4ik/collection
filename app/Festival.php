<?php

namespace App;

class Festival extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->is_default == 1) {
                Festival::where('is_default', 1)
                    ->where('id','<>', $model->id)
                    ->update(['is_default' => 0]);
            }
        });
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('name->ru');
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                //$query->whereRaw('lower(JSON_UNQUOTE(name->"$.ru")) like lower(?)', ["%{$search}%"]);
                $query->whereRaw('lower(name) like lower(?)', ["%{$search}%"]);
            });
        });
    }

    public function partners()
    {
        return $this->belongsToMany(Partner::class);
    }
    
    
    
}