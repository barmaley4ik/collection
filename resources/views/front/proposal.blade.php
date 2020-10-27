@extends('front.layouts.app', 
['body_class' => 'page-template-default page page-id-12276 wolf wolf-mailchimp tattoopro wolf-woocommerce- wide-layout skin-light menu-transparent menu-default menu-dark menu-wide submenu-left-align menu-hover-plain-color no-secondary-menu page-header-none no-title-area is-vc-page is-sticky-menu is-top-bar no-header-image wpb-js-composer js-comp-ver-4.10 vc_responsive landscape nimbus-is-editor loaded sticky-menu'
])
@section('meta')
<title>Тайтл</title>
    <meta name="description" content="Деск" />
@endsection 

@push('custom-style')

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



@section('content')
    <div class="site-container" id="app">
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
                                        <div style="background-color:#808080;background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" id="members" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width news_block">
                                            <div class='wolf-row-inner' style='padding-top:10px;padding-bottom:10px;'>
                                                <div class="wrap">
                                                    <div class="col-12 wolf-col">
                                                        <div class="wpb_wrapper">
                                                            <h5 style='line-height:1;font-weight:500;letter-spacing:0px;text-transform:uppercase;' class='fittext text-center clearfix' data-max-font-size='36'>{{ __('front.form_name_member') }}</h5>
                                                        </div> 
                                                    </div> 
                                                </div><!--.wrap-->
                                            </div><!--.wolf-row-inner-->
                                        </div><!--.wolf-row-->                                        
 
                                            <form-proposal
                                            label-member-name="@lang('front.member_name')"
                                            label-form-name="@lang('front.form_name_member')"
                                            label-country="@lang('front.country')"
                                            label-city="@lang('front.city')"
                                            label-studio="@lang('front.studio')"
                                            label-phone="@lang('front.phone')"
                                            label-comment="@lang('front.comment')"
                                            label-portfolio="@lang('front.portfolio')"
                                            label-profile="@lang('front.photo_profile')"
                                            label-place-format="@lang('front.place_format')"
                                            label-specialization="@lang('front.specialization')"
                                            label-count-worker="@lang('front.count_worker')"
                                            label-place-number="@lang('front.place_number')"
                                            label-proposal-attention="{{__('front.proposal_attention')}}"
                                            festival_id="{{ $festival->id}}"
                                            language_id="{{ $language_id}}"
                                            :countries='@json($countries)'
                                            :specializations='@json($specializations)'
                                            :placeformats='@json($placeformats)'
                                            error-filesize="@lang('front.error_filesize')"
                                            error-fileext="@lang('front.error_fileext')"
                                            error-required="@lang('front.error_required')"
                                            error-mail="@lang('front.error_mail')"
                                            error-header-part="@lang('front.msg_error')"
                                            label-send="@lang('front.button_send')"
                                                                                        
                                            
                                            ></form-proposal>
                                    

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
