<?php

namespace App\Providers;

use Inertia\Inertia;
use League\Glide\Server;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use App\Helpers\Helpme;

use App\Front\Setting;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        
        Date::use(CarbonImmutable::class);

        //langs
        $defaultLanguage = Helpme::defaultLanguage();
        config(['app.locale' => $defaultLanguage]);

        $languages = Helpme::languages();
        config(['app.locales' => $languages->toArray()]);

        //settings
        $setting = Setting::first();

        $social = json_decode($setting->social);


        $socials['facebook']['url'] = Str::beforeLast($social->facebook, ':');
        $socials['facebook']['api'] = Str::afterLast($social->facebook, ':');
        $socials['instagram']['url'] = Str::beforeLast($social->instagram, ':');
        $socials['instagram']['key'] = Str::afterLast($social->instagram, ':');
        $socials['youtube']['url'] = $social->youtube;


                                        
        
        $currentUrl = request()->getHttpHost();
        $domainParam = explode('.', $currentUrl);
        $domainParam = $domainParam[0] ;

        $appUrl = Str::afterLast(env('APP_URL',''), '/');
        $isDomain = !($currentUrl === $appUrl);

        \View::share([

            'languages' => $languages,
            'setting' => $setting,
            'socials' => $socials,
            'isDomain' => $isDomain,
            'domainParam' => $domainParam,
        ]);     

        
    }

    public function register()
    {
        $this->registerInertia();
        $this->registerGlide();
        $this->registerLengthAwarePaginator();
    }

    public function registerInertia()
    {
        Inertia::version(function () {
            return md5_file(public_path('mix-manifest.json'));
        });

        Inertia::share([
            'auth' => function () {
                return [
                    'user' => Auth::user() ? [
                        'id' => Auth::user()->id,
                        'first_name' => Auth::user()->first_name,
                        'last_name' => Auth::user()->last_name,
                        'email' => Auth::user()->email,
                        'role' => Auth::user()->role,
                    ] : null,
                ];
            },
            'flash' => function () {
                return [
                    'success' => Session::get('success'),
                    'error' => Session::get('error'),
                ];
            },
            'errors' => function () {
                return Session::get('errors')
                    ? Session::get('errors')->getBag('default')->getMessages()
                    : (object) [];
            },
        ]);
    }

    protected function registerGlide()
    {
        $this->app->bind(Server::class, function ($app) {
            return Server::create([
                'source' => Storage::getDriver(),
                'cache' => Storage::getDriver(),
                'cache_folder' => '.glide-cache',
                'base_url' => 'img',
            ]);
        });
    }

    protected function registerLengthAwarePaginator()
    {
        $this->app->bind(LengthAwarePaginator::class, function ($app, $values) {
            return new class(...array_values($values)) extends LengthAwarePaginator {
                public function only(...$attributes)
                {
                    return $this->transform(function ($item) use ($attributes) {
                        return $item->only($attributes);
                    });
                }

                public function transform($callback)
                {
                    $this->items->transform($callback);

                    return $this;
                }

                public function toArray()
                {
                    return [
                        'data' => $this->items->toArray(),
                        'links' => $this->links(),
                    ];
                }

                public function links($view = null, $data = [])
                {
                    $this->appends(Request::all());

                    $window = UrlWindow::make($this);

                    $elements = array_filter([
                        $window['first'],
                        is_array($window['slider']) ? '...' : null,
                        $window['slider'],
                        is_array($window['last']) ? '...' : null,
                        $window['last'],
                    ]);

                    return Collection::make($elements)->flatMap(function ($item) {
                        if (is_array($item)) {
                            return Collection::make($item)->map(function ($url, $page) {
                                return [
                                    'url' => $url,
                                    'label' => $page,
                                    'active' => $this->currentPage() === $page,
                                ];
                            });
                        } else {
                            return [
                                [
                                    'url' => null,
                                    'label' => '...',
                                    'active' => false,
                                ],
                            ];
                        }
                    })->prepend([
                        'url' => $this->previousPageUrl(),
                        'label' => 'Назад',
                        'active' => false,
                    ])->push([
                        'url' => $this->nextPageUrl(),
                        'label' => 'Вперед',
                        'active' => false,
                    ]);
                }
            };
        });
    }
}