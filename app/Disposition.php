<?php

namespace App;

class Disposition extends Model
{
    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }

    public function dispositionPlaces()
    {
        return $this->hasMany(DispositionPlace::class);
    }        
}
