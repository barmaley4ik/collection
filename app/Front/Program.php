<?php

namespace App\Front;
use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;

class Program extends Model
{
    use HasTranslations;

    protected $dates = ['day'];

    public $translatable = [
        'text_day',
    ];

    public function festival()
    {
        return $this->belongsTo(Festival::class);
    }  
}
