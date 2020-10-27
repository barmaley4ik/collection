<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;


class Specialization extends Model
{

    public function scopeForMembers($query)
    {
        $query->whereType(1);
    }

    public function scopeForShopPlaces($query)
    {
        $query->whereType(0);
    }  

}
