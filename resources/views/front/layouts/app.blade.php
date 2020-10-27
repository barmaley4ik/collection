<html lang="{{ app()->getLocale() }}">
    <head>
    <!-- Meta Tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    @yield('meta')  
    <!-- Favicons 5565-->
    <link rel="shortcut icon" href="{{secure_asset('css/images/favicon.ico')}}">
{{--     <link rel="apple-touch-icon" href="http://tattoo-collection.kiev.ua/wp-content/themes/tattoopro/images/favicons/touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="http://tattoo-collection.kiev.ua/wp-content/themes/tattoopro/images/favicons/touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="http://tattoo-collection.kiev.ua/wp-content/themes/tattoopro/images/favicons/touch-icon-114x114.png"> --}}


    <!--[if lt IE 9]>
        <script src="http://tattoo-collection.kiev.ua/wp-content/themes/tattoopro/js/lib/html5shiv.min.js" type="text/javascript"></script>
    <![endif]-->
        {{-- 555 --}}
    <link rel='dns-prefetch' href='//maxcdn.bootstrapcdn.com'/>
    <link rel='dns-prefetch' href='//fonts.googleapis.com'/>
    <link rel="stylesheet" id='dashicons-css' type='text/css' media='all' href="{{secure_asset('css/front/dashicons.min.css')}}">
    <link rel="stylesheet" id='tattoopro-style-min-css' type='text/css' media='all' href="{{secure_asset('css/front/main.min.css')}}">
    <link rel="stylesheet" id='tattoopro-default-css' type='text/css' media='all' href="{{secure_asset('css/front/style.css')}}">
    {{-- <link rel="stylesheet" id='contact-form-7-css' type='text/css' media='all' href="{{asset('css/front/styles_cf.css')}}"> --}}
    <link rel="stylesheet" id='sb_instagram_styles-css' type='text/css' media='all' href="{{secure_asset('css/front/sb-instagram.min.css')}}">
    <link rel="stylesheet" id='rs-plugin-settings-css' type='text/css' media='all' href="{{secure_asset('css/front/revslider.css')}}">
    <link rel="stylesheet" id='js_composer_front-css' type='text/css' media='all' href="{{secure_asset('css/front/js_composer.min.css')}}">
    <link rel="stylesheet" id='bootstrap-css' type='text/css' media='all' href="{{secure_asset('css/front/bootstrap.min.css')}}">
    <link rel="stylesheet" id='jquery-lazyloadxt-spinner-css-css' type='text/css' media='all' href="{{secure_asset('css/front/jquery.lazyloadxt.spinner.css')}}">
    @stack('custom-style')
    @stack('custom-scripts')

    <script>
        window.langs = @json(Helpme::languages());
        window.deflocale = @json(Helpme::defaultLanguage());
    </script> 
    <script src="{{ mix('/js/app_front.js') }}" defer></script>    

    <!--[if lte IE 8]>
    <link rel='stylesheet' id='tattoopro-ie8-style-css'  href='/css/front/ie8.css' type='text/css' media='all' />
    <![endif]-->

    <style id='rs-plugin-settings-inline-css' type='text/css'>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,800,300,700);.tp-caption a{color:#ffffff;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffffff}.tp-caption a{color:#ffffff;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffffff}.tp-caption a{color:#ff7302;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffffff}.tp-caption a{color:#ff7302;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffffff}.tp-caption a{color:#ffffff;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffa902}.tp-caption a{color:#ff7302;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffa902}.tp-caption a{color:#ff7302;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffffff}.tp-caption a{color:#ffffff;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffffff}.tp-caption a{color:#ffffff;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffa902}.tp-caption a{color:#ffffff;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffa902}.tp-caption a{color:#ff7302;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffa902}.tp-caption a{color:#ffffff;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffa902}.tp-caption a{color:#ffffff;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffffff}.tp-caption a{color:#ffffff;text-shadow:none;-webkit-transition:all 0.2s ease-out;-moz-transition:all 0.2s ease-out;-o-transition:all 0.2s ease-out;-ms-transition:all 0.2s ease-out}.tp-caption a:hover{color:#ffa902}
    </style>
    <link rel='stylesheet' id='wolf-theme-google-fonts-css' href='//fonts.googleapis.com/css?family=Merriweather:400,700|Source+Sans+Pro:400&#038;subset=latin,latin-ext' type='text/css' media='all'/>

    <script type='text/javascript' src='{{secure_asset('js/front/jquery.js')}}'></script>
    <script type='text/javascript' src='{{secure_asset('js/front/jquery-migrate.min.js')}}'></script>
    <script type='text/javascript' src='{{secure_asset('js/front/jquery.themepunch.tools.min.js')}}'></script>
    <script type='text/javascript' src='{{secure_asset('js/front/jquery.themepunch.revolution.min.js')}}'></script>
    <script type='text/javascript' src='{{secure_asset('js/front/modernizr.js')}}'></script>
    <script type='text/javascript' src='{{secure_asset('js/front/mediaelement-and-player.min.js')}}'></script>
    <script type='text/javascript' src='{{secure_asset('js/front/mediaelement-migrate.min.js')}}'></script>
    <script type='text/javascript' src='{{secure_asset('js/front/InstagramFeed.js')}}'></script>
    {{-- <link rel="stylesheet" href="{{asset('css/front/font-awesome.min.css')}}"> --}}
    <script type='text/javascript'>
    /* <![CDATA[ */
    var _wpmejsSettings = {"pluginPath":"\/wp-includes\/js\/mediaelement\/","classPrefix":"mejs-","stretching":"responsive"};
    /* ]]> */
    </script>
    {{-- <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://tattoo-collection.kiev.ua/wp-includes/wlwmanifest.xml"/>  --}}
    <meta name="generator" content="WEBIKO"/>
    <link rel="canonical" href="http://tattoo-collection.kiev.ua/"/>
    <link rel='shortlink' href='http://tattoo-collection.kiev.ua/'/>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            // CUSTOM AJAX CONTENT LOADING FUNCTION
            var ajaxRevslider = function(obj) {
                // obj.type : Post Type
                // obj.id : ID of Content to Load
                // obj.aspectratio : The Aspect Ratio of the Container / Media
                // obj.selector : The Container Selector where the Content of Ajax will be injected. It is done via the Essential Grid on Return of Content
                
                var content = "";

                data = {};
                
                data.action = 'revslider_ajax_call_front';
                data.client_action = 'get_slider_html';
                data.token = 'f62aac89a8';
                data.type = obj.type;
                data.id = obj.id;
                data.aspectratio = obj.aspectratio;
                
                    // FIRST RETURN THE CONTENT WHEN IT IS LOADED !!
                    return content;						 
            };
            
            // CUSTOM AJAX FUNCTION TO REMOVE THE SLIDER
            var ajaxRemoveRevslider = function(obj) {
                return jQuery(obj.selector+" .rev_slider").revkill();
            };

            // EXTEND THE AJAX CONTENT LOADING TYPES WITH TYPE AND FUNCTION
            var extendessential = setInterval(function() {
                if (jQuery.fn.tpessential != undefined) {
                    clearInterval(extendessential);
                    if(typeof(jQuery.fn.tpessential.defaults) !== 'undefined') {
                        jQuery.fn.tpessential.defaults.ajaxTypes.push({type:"revslider",func:ajaxRevslider,killfunc:ajaxRemoveRevslider,openAnimationSpeed:0.3});   
                        // type:  Name of the Post to load via Ajax into the Essential Grid Ajax Container
                        // func: the Function Name which is Called once the Item with the Post Type has been clicked
                        // killfunc: function to kill in case the Ajax Window going to be removed (before Remove function !
                        // openAnimationSpeed: how quick the Ajax Content window should be animated (default is 0.3)
                    }
                }
            },30);
        });
    </script>
    <link rel="alternate" href="http://tattoo-collection.kiev.ua/" hreflang="ru"/>
    <link rel="alternate" href="http://tattoo-collection.kiev.ua/en/" hreflang="en"/>
    <link rel="alternate" href="http://tattoo-collection.kiev.ua/uk/" hreflang="uk"/>

    <style type="text/css">/* Theme settings */
     a, .add_to_cart_button:hover, .wolf-button:hover, input[type='submit']:hover, input[type='reset']:hover, .wolf-social:hover, .wolf-show-ticket-button:hover, .team-member-social-container a:hover, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .content-light-font h1 a:hover, .content-light-font h2 a:hover, .content-light-font h3 a:hover, .content-light-font h4 a:hover, .content-light-font h5 a:hover, .content-light-font h6 a:hover, .site-footer a:hover, #site-navigation-secondary a:hover, .comment-reply-link, .widget a:not(.button):not(.wolf-button):hover, figure.effect-sadie .entry-meta a, #top-bar #lang_sel a.lang_sel_sel:hover, .video-sidebar-container .video-title a:hover, .video-category .video-author-name a:hover, .single-video .video-author-meta .video-author-name a:hover, .has-bg h2.entry-title a:hover, .post-archives .entry-content a:hover, .video-youtube-all.single-video .video-author-meta .video-author-name a:hover, .video-youtube.single-video .video-author-meta .video-author-name a:hover, .wolf-bigtweet-content:before{ color:#808080} .entry-meta a:hover, .edit-link a:hover, #work-filter a.active, #work-filter a:hover, #video-filter a.active, #video-filter a:hover, #gallery-filter a.active, #gallery-filter a:hover, #plugin-filter a.active, #plugin-filter a:hover, #theme-filter a.active, #theme-filter a:hover, #demo-filter a.active, #demo-filter a:hover, .menu-hover-text-color .nav-menu li a:hover, .menu-hover-text-color .nav-menu li.current-menu-item > a:first-child, .menu-hover-text-color .nav-menu li.current-menu-ancestor > a:first-child, .menu-hover-text-color .nav-menu li.active a:first-child, input[type='submit']#place_order:hover{ color:#808080!important; } a#scroll-down:hover, a#top-arrow:hover, input[type='submit'], input[type='reset'], .wolf-button, .button, .add_to_cart_button, .wolf-show-ticket-button{ background:#808080; border-color:#808080; } .content-light-font .border-button-accent-hover:hover, .border-button-accent-hover:hover, .trigger, .sidebar-footer input[type='submit'].wolf-mailchimp-submit:hover, input[type='submit']#place_order{ background:#808080!important; border-color:#808080!important; } .sidebar-footer .wolf-mailchimp-email:focus, .bypostauthor .avatar{ border-color:#808080; } .wolf-social.square:hover, .wolf-social.circle:hover { background: #808080; border-color: #808080; } .vc_progress_bar .vc_single_bar .vc_bar, .mejs-container .mejs-controls .mejs-time-rail .mejs-time-current, .mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current{ background:#808080!important; } .wolf-social.hover-fill-in.square:hover, .wolf-social.hover-fill-in.circle:hover, .wolf-social.circle.wolf-social-no-custom-style.hover-fill-in:hover, .wolf-social.square.wolf-social-no-custom-style.hover-fill-in:hover, .icon-box.icon-type-circle .wolf-icon-no-custom-style.hover-fill-in:hover, .icon-box.icon-type-square .wolf-icon-no-custom-style.hover-fill-in:hover{ -webkit-box-shadow: inset 0 0 0 1em #808080; box-shadow: inset 0 0 0 1em #808080; border-color: #808080; } .icon-box.icon-type-circle .wolf-icon-no-custom-style.hover-none:hover, .icon-box.icon-type-square .wolf-icon-no-custom-style.hover-none:hover{ background:#808080; border-color:#808080!important; } .pricing-table-currency, .pricing-table-price, .pricing-table-strike:before{ color:#808080!important; } #navbar-container .nav-menu li.button-style > a:first-child span, #navbar-container-left .nav-menu li.button-style > a:first-child span, #navbar-mobile .nav-menu li.button-style > a:first-child span{ background-color:#808080!important; } #navbar-container .nav-menu li.button-style > a:first-child span:hover, #navbar-container-left .nav-menu li.button-style > a:first-child span:hover, #navbar-mobile .nav-menu li.button-style > a:first-child span:hover{ background:#606060; } figure.effect-sadie .item-icon, #infscr-loading, .shortcode-videos-grid figure, .shortcode-works-grid figure, .shortcode-plugins-grid figure, .shortcode-albums-grid figure, .pricing-table-featured, .pricing-table-inner ul li.pricing-table-button a:hover, .pricing-table-active ul li.pricing-table-button a , .nav-menu .product-count, .menu .product-count, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, .woocommerce span.onsale, .woocommerce-page span.onsale, .woocommerce .woocommerce-tabs .panel, .woocommerce-page .woocommerce-tabs .panel, .woocommerce .woocommerce-tabs ul.tabs li.active, .woocommerce-page .woocommerce-tabs ul.tabs li.active, .pricing-table-price-strike:before, .notif-count{ background:#808080; } ::-moz-selection{ background-color:#808080!important; } ::selection{ background-color:#808080!important; } .is-home-header .hero-inner {background : url("http://assets.wolfthemes.com/tf/tattoopro/7013355679_4fd4d8e84b_o.jpg") center center no-repeat }.is-home-header .hero-inner { -webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%; -webkit-background-size: cover; -o-background-size: cover; background-size: cover; }.is-home-header .header-overlay{background-color:#000;}.is-home-header .header-overlay{opacity:0.35} #navbar-container .nav-menu li.cart-menu-item .cart-menu-panel, #navbar-container .nav-menu li ul.sub-menu, #navbar-container .nav-menu li ul.children, .menu-hover-plain-color #navbar-container .nav-menu li:hover a, .menu-hover-plain-color #navbar-container .nav-menu li.current-menu-item > a:first-child, .menu-hover-plain-color #navbar-container .nav-menu li.current-menu-ancestor > a:first-child, .menu-hover-plain-color #navbar-container .nav-menu li.active > a:first-child, .sticky-menu.menu-hover-plain-color #navbar-container .nav-menu li:hover a, .sticky-menu.menu-hover-plain-color #navbar-container .nav-menu li.current-menu-item > a:first-child, .sticky-menu.menu-hover-plain-color #navbar-container .nav-menu li.current-menu-ancestor > a:first-child, .sticky-menu.menu-hover-plain-color #navbar-container .nav-menu li.active > a:first-child{ background-color:#808080!important; } .menu-hover-border-top.menu-transparent.is-home-header .nav-menu li:hover a, .menu-hover-border-top.menu-semi-transparent.is-home-header .nav-menu li:hover a, .menu-hover-border-top.menu-transparent.is-home-header .nav-menu li.current-menu-item > a:first-child, .menu-hover-border-top.menu-transparent.is-home-header .nav-menu li.current-menu-ancestor > a:first-child, .menu-hover-border-top.menu-semi-transparent.is-home-header .nav-menu li.current-menu-item > a:first-child, .menu-hover-border-top.menu-semi-transparent.is-home-header .nav-menu li.current-menu-ancestor > a:first-child, .menu-hover-border-top.menu-transparent.has-header-image.show-title-area .nav-menu li:hover a, .menu-hover-border-top.menu-semi-transparent.has-header-image.show-title-area .nav-menu li:hover a, .menu-hover-border-top.menu-transparent.has-header-image.show-title-area .nav-menu li.current-menu-item > a:first-child, .menu-hover-border-top.menu-transparent.has-header-image.show-title-area .nav-menu li.current-menu-ancestor > a:first-child, .menu-hover-border-top.menu-semi-transparent.has-header-image.show-title-area .nav-menu li.current-menu-item > a:first-child, .menu-hover-border-top.menu-semi-transparent.has-header-image.show-title-area .nav-menu li.current-menu-ancestor > a:first-child { -webkit-box-shadow: inset 0px 3px 0px 0px #808080; box-shadow: inset 0px 3px 0px 0px #808080; } /*#navbar-container-right .wolf-social, #navbar-container-right .widget-title, #navbar-container-right, #navbar-container-right a, #navbar-container-right a:hover, #navbar-container-right .wolf-twitter-widget ul.wolf-tweet-list li:before,*/ .wolf #navbar-container .nav-menu li.cart-menu-item .cart-menu-panel a, .wolf #navbar-container .nav-menu li ul.sub-menu span, .wolf #navbar-container .nav-menu li ul.children span, .wolf #navbar-container .nav-menu li ul.sub-menu li:before, .wolf #navbar-container .nav-menu li ul.children li:before, .menu-dark.menu-hover-plain-color .nav-menu li:hover a, .menu-dark.menu-hover-plain-color .nav-menu li.current-menu-item > a:first-child, .menu-dark.menu-hover-plain-color .nav-menu li.current-menu-ancestor > a:first-child, .menu-light.menu-hover-plain-color .nav-menu li:hover a, .menu-light.menu-hover-plain-color .nav-menu li.current-menu-item > a:first-child, .menu-light.menu-hover-plain-color .nav-menu li.current-menu-ancestor > a:first-child, .sticky-menu.menu-hover-plain-color #navbar-container .nav-menu li:hover a, .sticky-menu.menu-hover-plain-color #navbar-container .nav-menu li.current-menu-item > a:first-child, .sticky-menu.menu-hover-plain-color #navbar-container .nav-menu li.current-menu-ancestor > a:first-child{ color:#ffffff!important; } #loading-overlay{background:#333}.loader2-double-bounce1, .loader2-double-bounce2, .loader3 > div, .loader4-cube1, .loader4-cube2, .loader5, .loader6-dot1, .loader6-dot2, .loader7 > div, .loader8-container1 > div, .loader8-container2 > div, .loader8-container3 > div {background-color:#fff}.entry-meta, .category, .edit-link, .author-link, .author-description, .share-link, .page-title-container .subheading, .page-title-container .category-description p{font-family:'Source Sans Pro'}.entry-meta, .category, .edit-link, .author-link, .author-description, .share-link, .page-title-container .subheading, .page-title-container .category-description p{font-style:normal}h1, h2, h3, h4, h5, h2.entry-title, .widget-title, .counter-text, .countdown-period, .wolf-slide-title{font-family:'Source Sans Pro'}h1, h2, h3, h4, h5, h2.entry-title, .widget-title, .counter-text, .countdown-period, .wolf-slide-title{font-weight:400}h1, h2, h3, h4, h5, h2.entry-title, .widget-title, .counter-text, .countdown-period, .wolf-slide-title{text-transform:uppercase}h1, h2, h3, h4, h5, h2.entry-title, .widget-title, .counter-text, .countdown-period, .wolf-slide-title{font-style:normal}h1, h2, h3, h4, h5, h2.entry-title, .widget-title, .counter-text, .countdown-period, .wolf-slide-title{letter-spacing:2px}h1.page-title{font-family:'Source Sans Pro'}h1.page-title{font-style:normal}.nav-menu li a, #navbar-container-right{ font-family:'Source Sans Pro'}.nav-menu li a, #navbar-container-right{text-transform:uppercase}.nav-menu li a, #navbar-container-right{font-style:normal}.nav-menu li a, #navbar-container-right{letter-spacing:2px}body, blockquote.testimonial-content, .wolf-slide-subtitle{font-family:'Source Sans Pro'}#top-bar .theme-socials-container { margin: 0px; } .infos-container { margin-left:auto; text-align:center; padding-left:20%; width: 86%; } .theme-socials-container { width: 14%; } .wrap { width:100%; } .wolf-flags-container { float: none; margin-right:auto; } .logo a img { max-height: 210px; top:-72px; } #top-bar { position: initial; } .sticky-menu #navbar-container .nav-menu li a { line-height: 100px; } .sticky-menu .logo a img { max-height: 100px; top: 0; } @media screen and (max-width:1280px) and (min-width:1140px) { .logo a img { max-height: 180px; top: -52px; } } @media (max-width: 1024px) { .breakpoint #top-bar { width:90%; } .breakpoint #top-bar .wrap .infos-container { width:100%; } .breakpoint #top-bar .wolf-flags-container a { font-size: 20px; padding: 0px 2px; color:#fff; } .breakpoint #top-bar .wolf-flags-container a.lang-item-uk { padding-right: 0px; } } .logo_association { width: 50%; margin-right: auto; margin-left: 40%; padding-top: 20px; } @media screen and (max-width: 1024px){ .logo_association { margin-left: 25%; } } @media screen and (max-width: 768px){ .logo_association { width: 45%; margin-left: 40%; } } @media screen and (max-width: 414px){ .logo_association { width: 35%; margin: auto; padding-top: 0px; } } @media screen and (max-width: 360px){ .logo_association { width: 35%; } } @media screen and (max-width: 320px){ .logo_association { width: 37%; } }</style><style type="text/css"></style>		<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
    <style type="text/css">
        #overlay-sidebar {
            width: 380px;
            margin: 0 0 0 -190px;
        }
        #slide-sidebar {
            width: 380px;
            right:-423px; // width + 43px
            bottom: 20px;
        }
    </style>
    <noscript><style type="text/css"> .wpb_animate_when_almost_visible { opacity: 1; }</style></noscript>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-86426033-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-86426033-1');
    </script>
    <style type="text/css">
    @media screen and (max-width:1280px) and (min-width:1140px) {
        .logo a img {
            max-height: 180px;
            top: -52px;
        }
    }
    </style>
    </head>
    <body class="{{$body_class}}">
        @include('front.components.header')
   
        @yield('content')
        
        @include('front.components.footer')  

            <script type='text/javascript' src='{{secure_asset('js/front/wp-mediaelement.min.js')}}'></script>
            <script type='text/javascript'>
            /* <![CDATA[ */
            var WolfThemeParams = {"ajaxUrl":"http:\/\/tattoo-collection.kiev.ua\/wp-admin\/admin-ajax.php","siteUrl":"http:\/\/tattoo-collection.kiev.ua\/","accentColor":"","headerPercent":"85","breakPoint":"1140","lightbox":"none","videoLightbox":null,"footerUncover":null,"headerUncover":null,"sliderEffect":"slide","sliderAutoplay":null,"sliderSpeed":"5000","sliderPause":null,"infiniteScroll":null,"infiniteScrollMsg":"Loading...","infiniteScrollEndMsg":"No more post to load","loadMoreMsg":"Load More","infiniteScrollEmptyLoad":"http:\/\/tattoo-collection.kiev.ua\/wp-content\/themes\/tattoopro\/images\/empty.gif","newsletterPlaceholder":"Your email","isHomeSlider":null,"heroFadeWhileScroll":"true","heroParallax":"","homeHeaderType":"revslider","isHome":"","blogWidth":"wide","menuPosition":"default","modernMenu":"","currentPostType":[],"enableParallaxOnMobile":null,"enableAnimationOnMobile":null,"doPageTransition":"1","doBackToTopAnimation":"1","onePageMenu":"","onePagePage":"http:\/\/tattoo-collection.kiev.ua\/","isOnePageOtherPage":"1","isStickyMenu":"true","addMenuType":"side","workType":null,"isTopbar":"yes","menuStyle":"transparent","years":"Years","months":"Months","weeks":"Weeks","days":"Days","hours":"Hours","minutes":"Minutes","seconds":"Seconds","replyTitle":"Share your thoughts","doWoocommerceLightbox":"1","leftMenuTransparency":null,"layout":"wide","HomeHeaderVideoBgType":"youtube"};
            /* ]]> */
            </script>
            <script type='text/javascript' src='{{secure_asset('js/front/app.min.js')}}'></script>
            <script type='text/javascript'>
            /* <![CDATA[ */
            var a3_lazyload_params = {"apply_images":"1","apply_videos":"1"};
            /* ]]> */
            </script>
            <script type='text/javascript' src='{{secure_asset('js/front/jquery.lazyloadxt.extra.min.js')}}'></script>
            <script type='text/javascript' src='{{secure_asset('js/front/jquery.lazyloadxt.srcset.min.js')}}'></script>

            <script type='text/javascript'>
                var a3_lazyload_extend_params = {"edgeY":"0"};
            </script>
            <script type='text/javascript' src='{{secure_asset('js/front/jquery.lazyloadxt.extend.js')}}'></script>
            <script type='text/javascript' src='{{secure_asset('js/front/wp-embed.min.js')}}'></script>
            <script type='text/javascript' src='{{secure_asset('js/front/js_composer_front.min.js')}}'></script>
            <script type='text/javascript' src='{{secure_asset('js/front/jquery.countdown.min.js')}}'></script>

            <script type="text/javascript">
                        var date = new Date();
                        date.setTime( date.getTime() + 31536000 );
                        document.cookie = "pll_language=ru; expires=" + date.toUTCString() + "; path=/";
            </script>
          
    </body>
  
</html>
