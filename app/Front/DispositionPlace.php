<?php

namespace App\Front;
use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;

class DispositionPlace extends Model
{
    use HasTranslations;


    public $translatable = [
        'place',
        'member',

    ];

    public function disposition()
    {
        return $this->belongsTo(Disposition::class);
    }   
}
