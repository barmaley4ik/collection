<?php

namespace App;

class Partner extends Model
{

    public function scopeOrderByName($query)
    {
        $query->orderBy('name->ru');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereRaw('lower(JSON_UNQUOTE(name->"$.ru")) like lower(?)', ["%{$search}%"]);
            });
        });
    }
    
    public function festivals()
    {
        return $this->belongsToMany(Festival::class);
    }    
}
