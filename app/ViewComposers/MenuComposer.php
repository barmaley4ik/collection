<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Request;

use Illuminate\Support\Str;
class MenuComposer
{
    protected $menus;


    /**
     * Create a new menu composer.
     *
     * @return void
     */
    public function __construct()
    {
        $currentUrl = request()->getHttpHost();
        $domainParam = explode('.', $currentUrl);
        $domainParam = $domainParam[0] ;

        $appUrl = Str::afterLast(env('APP_URL',''), '/');
        $isDomain = !($currentUrl === $appUrl);


        $submenus[0]['title']=__('front.condition');
        $submenus[0]['url']= $isDomain ? localized_route('fest.condition',['domain' => $domainParam]) : localized_route('condition');

        $submenus[1]['title']=__('front.fill_form');
        $submenus[1]['url']=($isDomain ? localized_route('fest.proposal-member',['domain' => $domainParam]) : localized_route('proposal-member'));

        $submenus[2]['title']=__('front.fill_form_tm');
        $submenus[2]['url']=($isDomain ? localized_route('fest.proposal-biz',['domain' => $domainParam]) : localized_route('proposal-biz'));      

        $submenus[3]['title']=__('front.disposition');
        $submenus[3]['url']=$isDomain ? localized_route('fest.disposition',['domain' => $domainParam]) : localized_route('disposition');

        $submenus[4]['title']=__('front.wheretolive');
        $submenus[4]['url']=$isDomain ? localized_route('fest.hotel',['domain' => $domainParam]) : localized_route('hotel');

        $submenus[5]['title']=__('front.volunteers');
        $submenus[5]['url']='https://docs.google.com/forms/d/1_SLhRJl53y2A28rJUQfBu8l3txBntfz2Tc-SeCobE-4/viewform?fbclid=IwAR390O-sGmj6zSyquNw4S8K_8ztZcAevSB3NMK3GQxTjatEHq4E7LdjHdbk&edit_requested=true';

        $submenus[6]['title']=__('front.smi');
        $submenus[6]['url']='https://docs.google.com/forms/d/e/1FAIpQLSepvvIChcT4kDVN30wpf7qk25ynhMH6fs7a8gtaDTkIpZlkNg/viewform?fbclid=IwAR1evWlo0vRZnY9qhoLZVkkj4eTwV53mKBHngICudx6mz1z5V21TVRRKrJc';

        $submenus[7]['title']=__('front.partners');
        $submenus[7]['url']=($isDomain ? localized_route('fest.home',['domain' => $domainParam]) : localized_route('home')) .'#partners';

        $submenus[8]['title']=__('front.food_court');
        $submenus[8]['url']='https://docs.google.com/forms/d/e/1FAIpQLSdQ8KoZkHlEC3ZVcJ1IYxkK-C0kzSMQfgClujpqWRyFe77giQ/viewform'; 

        $menus=[
            '1' =>[
                'title'=>__('front.info'),
                'url'=>'/',
                'submenu' => $submenus,
            ],
            '2' =>[
                'title'=>__('front.members'),
                'url'=>($isDomain ? localized_route('fest.home',['domain' => $domainParam]) : localized_route('home')) .'#members',
            ],
            '3' =>[
                'title'=>__('front.nominacii'),
                'url'=>($isDomain ? localized_route('fest.home',['domain' => $domainParam]) : localized_route('home')) .'#nomination',
            ],
            '4' =>[
                'title'=>__('front.menu_program'),
                'url'=>$isDomain ? localized_route('fest.program',['domain' => $domainParam]) : localized_route('program'),
            ],
            '5' =>[
                'title'=>__('front.gallery'),
                'url'=>($isDomain ? localized_route('fest.home',['domain' => $domainParam]) : localized_route('home')) .'#gallery',
            ],
            '6' =>[
                'title'=>__('front.tickets'),
                'url'=>('https://concert.ua/'. app()->getLocale().'/event/tattoo-collection'),
            ],
            '7' =>[
                'title'=>__('front.contacts'),
                'url'=>($isDomain ? localized_route('fest.home',['domain' => $domainParam]) : localized_route('home')) .'#contacts',
            ],                                                            
        ];

        $this->menus = $menus;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('menus', $this->menus);
    }
}