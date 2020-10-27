<?php

namespace App;

class DispositionPlace extends Model
{
    public function disposition()
    {
        return $this->belongsTo(Disposition::class);
    }   
}
