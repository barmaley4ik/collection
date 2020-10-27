<?php

namespace App;

class Slider extends Model
{

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }    

}
