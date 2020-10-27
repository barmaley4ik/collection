<?php

namespace App;

class Program extends Model
{

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }  
}
