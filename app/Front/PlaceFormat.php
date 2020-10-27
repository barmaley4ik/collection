<?php
namespace App\Front;
use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;


class PlaceFormat extends Model
{
    use HasTranslations;

    public $translatable = [
        'name',
    ];
        
    public function scopeForMembers($query)
    {
        $query->whereType(1);
    }

    public function scopeForShopPlaces($query)
    {
        $query->whereType(0);
    }  

}
