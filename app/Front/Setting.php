<?php

namespace App\Front;
use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;

class Setting extends Model
{
    use HasTranslations;

    public $translatable = [
        'name',
    ];

}
