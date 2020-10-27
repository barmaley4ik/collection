<?php

namespace App;

class Condition extends Model
{

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }    

}
