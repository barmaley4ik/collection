<?php

namespace App\Front;
use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;

class Condition extends Model
{
    use HasTranslations;


    public $translatable = [
        'header',
        'description',
        'meta_title',
        'meta_description',
    ];

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }    

}
