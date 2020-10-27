<?php

namespace App\Front;
use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;

class Language extends Model
{

    use HasTranslations;

    public $translatable = [
        'name',
    ];

    public function scopeOrderByName($query)
    {
        $query->orderBy('name');
    }

    public function scopeIsDefault($query)
    {
            $query->whereIsDefault(1)
            ->orderByName();
    }    
}
