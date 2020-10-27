<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(
            'front.components.menu', 'App\ViewComposers\MenuComposer'
        );

        // Using Closure based composers...
        View::composer(
            'front.components.mobile_menu', 'App\ViewComposers\MenuComposer'
        );

        View::composer(
            'front.components.modal', 'App\ViewComposers\ModalComposer'
        );        
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}