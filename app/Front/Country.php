<?php

namespace App\Front;
use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;

class Country extends Model
{
    use HasTranslations;

    public $translatable = [
        'name',

    ];

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function scopeOrderByName($query)
    {
        $query->orderBy('name->'.app()->getLocale());
    }

}
