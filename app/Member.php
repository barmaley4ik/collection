<?php

namespace App;

class Member extends Model
{

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function festival()
    {
        return $this->belongsTo(Festival::class);
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
  
}
