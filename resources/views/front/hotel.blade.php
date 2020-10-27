@extends('front.layouts.app', 
['body_class' => 'page-template-default page page-id-12276 wolf wolf-mailchimp tattoopro wolf-woocommerce- wide-layout skin-light menu-transparent menu-default menu-dark menu-wide submenu-left-align menu-hover-plain-color no-secondary-menu page-header-none no-title-area is-vc-page is-sticky-menu is-top-bar no-header-image wpb-js-composer js-comp-ver-4.10 vc_responsive landscape nimbus-is-editor loaded sticky-menu'
])
@section('meta')
<title>{{ $festival->hotel->meta_title }}</title>
    <meta name="description" content="{{ $festival->hotel->meta_description }}" />
@endsection 

@push('custom-style')

<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<style>
    .swiper-container {
      width: 100%;
      height: 420px;
    }
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      background-position: center;
      background-size: cover;
      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
  </style>
@endpush
@push('custom-scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
{{-- <script src="https://unpkg.com/swiper/js/swiper.min.js"></script> --}}
@endpush


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
                                <div id="post-810" class="post-810 page type-page status-publish hentry no-thumbnail text-only">
                                    <div class="entry-content">
                                        @if($festival->hotel)
                                        <div style="background-color:#808080;background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" id="members" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width news_block">
                                            <div class='wolf-row-inner' style='padding-top:10px;padding-bottom:10px;'>
                                                <div class="wrap">
                                                    <div class="col-12 wolf-col">
                                                        <div class="wpb_wrapper">
                                                            <h5 style='line-height:1;font-weight:500;letter-spacing:0px;text-transform:uppercase;' class='fittext text-center clearfix' data-max-font-size='36'>{{ $festival->hotel->header }}</h5>
                                                        </div> 
                                                    </div> 
                                                </div><!--.wrap-->
                                            </div><!--.wolf-row-inner-->
                                        </div><!--.wolf-row-->
                                        @include('front.components.hotel')
                                        @endif
                                        <br>
                                        <br>
                                        @include('front.components.partners')    
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
