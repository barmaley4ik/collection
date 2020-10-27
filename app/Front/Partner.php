<?php

namespace App\Front;
use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;

class Partner extends Model
{
    use HasTranslations;

    public $translatable = [
        'name',
        'meta_title',
        'meta_description',
        'description',
    ];

    public function festival()
    {
        return $this->belongsToMany(Festival::class);
    }

    public function festival_default()
    {
        return $this->festival()->where('is_default','=', 1)->firstOrFail();
    }

    public function festival_other($slug)
    {
        return $this->festival()
        ->where('is_default','=', 0)
        ->where('slug','=', $slug)
        ->firstOrFail();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }  
}
