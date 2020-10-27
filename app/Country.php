<?php

namespace App;

class Country extends Model
{

    public function members()
    {
        return $this->hasMany(Member::class);
    }

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
}
