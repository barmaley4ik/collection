@extends('front.layouts.app', 
['body_class' => 'page-template-default page page-id-12276 wolf wolf-mailchimp tattoopro wolf-woocommerce- wide-layout skin-light menu-transparent menu-default menu-dark menu-wide submenu-left-align menu-hover-plain-color no-secondary-menu page-header-none no-title-area is-vc-page is-sticky-menu is-top-bar no-header-image wpb-js-composer js-comp-ver-4.10 vc_responsive landscape nimbus-is-editor loaded sticky-menu'
])
@section('meta')
    <title>{{ $member->title }}</title>
    <meta name="description" content="{{ $member->description ?? '' }}" />
@endsection 
@section('content')
    <div class="site-container">
        <div id="page" class="hfeed site pusher">
            <div id="page-content">
                <!-- sliders -->
                {{-- @include('front.components.sliders') --}}
                <div id="main" class="site-main clearfix">
                    <div class="site-wrapper">
                        <div id="primary" class="content-area">
                            <main class="site-content" role="main">
                                <div id="post-12276" class="post-12276 page type-page status-publish hentry no-thumbnail text-only">
                                    <div class="entry-content">
                                        <!-- инфо -->
                                        @include('front.components.member_info')
                                        <!-- портфолио -->
                                        @include('front.components.member_portfolio')
                                        <!-- КОНТАКТЫ -->
                                        @include('front.components.contacts')
                                    </div><!-- .entry-content -->
                                </div><!-- #post -->
                            </main><!-- main#content .site-content-->
                        </div><!-- #primary .content-area -->
                    </div><!-- .site-wrapper -->
                </div><!-- #main -->
            </div><!-- #page-container -->
        <!-- footer -->
        </div><!-- #page .hfeed .site -->
    </div><!-- .site-container -->
     
@endsection
