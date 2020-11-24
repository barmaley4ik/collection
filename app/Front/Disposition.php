<?php

namespace App\Front;
use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;

class Disposition extends Model
{
    use HasTranslations;


    public $translatable = [
        'header',
        'meta_title',
        'meta_description',

    ];

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }

    public function dispositionPlaces()
    {
        return $this->hasMany(DispositionPlace::class)
        ->orderByRaw('length(json_unquote(json_extract(`place`,'. "'$.\"".app()->getLocale()."\"'))) asc")
        ->orderBy('place->'.app()->getLocale());
    }        
}
