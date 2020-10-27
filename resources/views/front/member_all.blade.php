@extends('front.layouts.app', 
['body_class' => 'page-template-default page page-id-12276 wolf wolf-mailchimp tattoopro wolf-woocommerce- wide-layout skin-light menu-transparent menu-default menu-dark menu-wide submenu-left-align menu-hover-plain-color no-secondary-menu page-header-none no-title-area is-vc-page is-sticky-menu is-top-bar no-header-image wpb-js-composer js-comp-ver-4.10 vc_responsive landscape nimbus-is-editor loaded sticky-menu'
])
@section('meta')
    <title>ALL Members</title>
    <meta name="description" content="Desc All members" />
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
                                        @if(count($festival->members)>0)
                                        <div style="background-color:#808080;background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" id="members" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width  news_block">
                                            <div class='wolf-row-inner' style='padding-top:0px;padding-bottom:0px;'>
                                                <div class="wrap">
                                                    <div class="col-12   wolf-col">
                                                        <div class="wpb_wrapper">
                                                            <h5 style='line-height:1;font-weight:500;letter-spacing:0px;text-transform:uppercase;color:#ffffff; line-height: 2.5; padding-top: 30px; margin-bottom: 0px; padding-bottom: 30px;' class='fittext text-center clearfix wow fadeIn' data-max-font-size='24'>{{ __('front.members') }}</h5>
                                                        </div> 
                                                    </div> 
                                                </div><!--.wrap-->
                                            </div><!--.wolf-row-inner-->
                                        </div><!--.wolf-row-->
                                        @foreach ($festival->members->chunk(4) as $chunk)
                                        <div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width ">
                                            <div class='wolf-row-inner' style='padding-top:2px;padding-bottom:0px;'>
                                                <div class="wrap">
                                                    @foreach ($chunk as $member)
                                                    <div class="col-3 wolf-col">
                                                        <div class="wpb_wrapper">
                                                            <div class='team-member-container text-center wow fadeInUp'>
                                                                <div class='team-member-photo'>
                                                                <a href="{{ $isDomain ? localized_route('fest.member',['member' => $member, 'domain' => $domainParam]) : localized_route('member',['member' => $member]) }}" title="{{ \Illuminate\Support\Str::title($member->name) }}" target='_self'>
                                                                <img class="lazy lazy-hidden" src="{{ secure_asset('css/images/lazy_placeholder.gif') }}" data-lazy-type="image" data-src='{{ $member->logo }}' alt='{{ $member->name }}'>
                                                                        <noscript><img src='{{ $member->logo }}' alt='{{ $member->name }}'></noscript>
                                                                    </a>
                                                                </div>
                                                                <h6 class='team-member-name'>{{ $member->name }}</h6>
                                                                @php
                                                                    $social = json_decode($member->social);
                                                                @endphp
                                                                <div class="team-member-social-container">
                                                                    <a href='{{ $member->country->logo ?? ''}}' style="pointer-events: none;" title='{{__('front.country')}}' target='_blank'>
                                                                    <img src="{{ $member->country->logo ?? ''}}" alt="{{__('front.country')}}" title="{{__('front.country')}}" width="24" height="24" style="vertical-align: sub;"></a>
                                                                    <a href='{{ $social->facebook ?? '#'}}' class='fa fa-facebook' title='facebook' target='_blank'></a>
                                                                    <a href='mailto:{{ $social->email ?? ''}}' class='fa fa-envelope' title='mail' target='_blank'></a>
                                                                    <a href='{{ $social->instagram ?? '#'}}' class='fa fa-instagram' title='instagram' target='_blank'></a>
                                                                    <a href='{{ $social->website ?? '#'}}' class='fa fa-globe' title='web' target='_blank'></a>
                                                                </div>
                                                            </div>
                                                            <div class='buttons-container wow fadeIn text-center' style='margin-top:5px;'>
                                                                <span class='button-container'>
                                                                    <a class='wolf-button medium square icon_after accent-color' href='{{ $isDomain ? localized_route('fest.member',['member' => $member, 'domain' => $domainParam]) : localized_route('member',['member' => $member]) }}' target='_self'>{{ __('front.more') }}</a>
                                                                </span>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    @endforeach 
                                                </div><!--.wrap-->
                                            </div><!--.wolf-row-inner-->
                                            <br>
                                        </div><!--.wolf-row-->
                                        @endforeach
                                        @endif
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
