<?php

namespace App\Front;
use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;

class Hotel extends Model
{
    use HasTranslations;

    public $translatable = [
        'header',
        'hotel',
        'meta_title',
        'meta_description',
    ];

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }    

}
