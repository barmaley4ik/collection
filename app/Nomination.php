<?php

namespace App;

class Nomination extends Model
{

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }  
}
