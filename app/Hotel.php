<?php

namespace App;

class Hotel extends Model
{

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }    

}
