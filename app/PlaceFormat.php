<?php

namespace App;

class PlaceFormat extends Model
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
