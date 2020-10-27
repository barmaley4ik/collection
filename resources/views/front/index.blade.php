@extends('front.layouts.app', 
['body_class' => 'home page-template-default page page-id-21 wolf wolf-mailchimp tattoopro wolf-woocommerce- wide-layout skin-light menu-transparent menu-default menu-dark menu-wide submenu-left-align menu-hover-plain-color no-secondary-menu page-header-none no-title-area is-vc-page is-sticky-menu is-top-bar home-header-revslider is-theme-home is-home-header no-header-image wpb-js-composer js-comp-ver-4.10 vc_responsive'
])
@section('meta')
    <title>{{ $festival->meta_title }}</title>
    <meta name="description" content="{{ $festival->meta_description ?? '' }}" />
@endsection    
@section('content')
  
    <div class="site-container">
        <div id="page" class="hfeed site pusher">
            <div id="page-content">
                <!-- sliders -->
                @include('front.components.sliders')
                <div id="main" class="site-main clearfix">
                    <div class="site-wrapper">
                        <div id="primary" class="content-area">
                            <main class="site-content" role="main">
                                <div id="post-21" class="post-21 page type-page status-publish hentry no-thumbnail text-only is-video">
                                    <div class="entry-content">
                                        <!-- coundown -->
                                        @include('front.components.countdown')
                                        <!-- УЧАСТНИКИ -->
                                        @include('front.components.members')
                                        <!-- ПРГРАММА КОНВЕНЦИИ -->
                                        @include('front.components.programs')

                                        <!-- НОМИНАЦИИ -->
                                        @include('front.components.nominations')
                                    
                                        <!-- ВАЖНАЯ информация -->
                                        @include('front.components.attention')    
                                        
                                        <!-- ПАРТНЕРЫ -->
                                        @include('front.components.partners')
                                        
                                        <!-- галерея -->
                                        @include('front.components.youtube_gallery')
                                        
                                        <!-- купить билет -->
                                        {{-- @include('front.components.buy_ticket') --}}
                                        
                                        <!-- КОНТАКТЫ -->
                                        @include('front.components.contacts')
                                        @if ($count_festivals>1)
                                        @include('front.components.modal')
                                        @endif
                                        
                                    </div><!-- .entry-content -->

                                </div><!-- #post -->

                                <a class="button" id="start_popup" href="#popup" style="visibility: hidden">Open Modal</a>
                                
            
                            </main><!-- main#content .site-content-->
                        </div><!-- #primary .content-area -->
                    </div><!-- .site-wrapper -->
                </div><!-- #main -->
            </div><!-- #page-container -->
        <!-- footer -->
        </div><!-- #page .hfeed .site -->
    </div><!-- .site-container -->
  
@endsection
