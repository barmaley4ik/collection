<?php

namespace App\Front;
use Illuminate\Database\Eloquent\Model;
use Brackets\Translatable\Traits\HasTranslations;

class Festival extends Model
{

    use HasTranslations;

    protected $dates = ['date_start', 'date_end'];

    public $translatable = [
        'name',
        'custom_text',
        'adress',
        'meta_title',
        'meta_description',
        'city',
    ];

    public function scopeOtherFestival($query,$slug)
    {
        $query
        ->whereSlug($slug)
        ->whereIsDefault(0)
        ->whereStatus(1);
    }

    public function scopeDefaultFestival($query)
    {
        $query
        ->whereIsDefault(1)
        ->whereStatus(1);
    } 

    public function scopeActive($query)
    {
        $query
        ->whereStatus(1);
    }  

    public function sliders()
    {
      return $this->hasMany(Slider::class)->orderBy('sort');
    }

    public function members()
    {
      return $this->hasMany(Member::class);
    }

    public function membersRandom()
    {
      return $this->hasMany(Member::class)->inRandomOrder()->limit(8);
    }

    public function programs()
    {
      return $this->hasMany(Program::class)->orderBy('day');
    } 

    public function nominations()
    {
      return $this->hasMany(Nomination::class)->orderBy('day');
    }
    
    public function partners()
    {
        return $this->belongsToMany(Partner::class);
    }
    
    public function condition()
    {
      return $this->hasOne(Condition::class);
    }

    public function disposition()
    {
      return $this->hasOne(Disposition::class);
    }

    public function hotel()
    {
      return $this->hasOne(Hotel::class);
    }

}



