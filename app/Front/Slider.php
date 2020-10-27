<?php

namespace App\Front;
use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;

class Slider extends Model
{
    use HasTranslations;

    public $translatable = [
        'text_slider',
    ];

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }    

}
