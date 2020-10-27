<header id="masthead" class="site-header clearfix" role="banner">
    <div class="header-overlay"></div>
    <div class="wolf-revslider-container">
        <div id="rev_slider_2_1_wrapper" class="rev_slider_wrapper fullscreen-container" style="background-color:#E9E9E9;padding:0px;">
<!-- START REVOLUTION SLIDER 4.6.5 fullscreen mode -->
            <div id="rev_slider_2_1" class="rev_slider fullscreenbanner" style="display:none;">
                <ul>	
            <!-- SLIDE  -->
                @foreach ($festival->sliders as $slider)
                <li data-transition="random" data-slotamount="7" data-masterspeed="300" data-saveperformance="on">
                    <!-- MAIN IMAGE -->
                <img src="{{ $slider->image }}" alt="collection_65778753_xl-2015-min" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                    <!-- LAYERS -->
                @if ($slider->is_button == 0)
                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption largewhitebg sfb tp-resizeme" data-x="15" data-y="200" data-speed="300" data-start="700" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300" style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;">{!! $slider->text_slider !!}</div>                    
                @else
                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption black tp-fade tp-resizeme" data-x="center" data-hoffset="0" data-y="center" data-voffset="0" data-speed="300" data-start="500" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="300" style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;"><a style="padding: 20px 20px; font-size: 25px; font-weight:850%; border-radius:0; letter-spacing:2px; border:3px solid #c808080; background: #808080; color:#ffffff;" class="" href="{{ $slider->url }}">{{ strip_tags($slider->text_slider) }}</a> 
                    </div>                    
                @endif    
                </li>
                                 
                @endforeach    
                </ul>
                <div class="tp-bannertimer"></div>	
            </div>


            <style scoped>.tp-caption.black,.black{color:#000;text-shadow:none}.tp-caption.largewhitebg,.largewhitebg{position:absolute;color:#000;text-shadow:none;font-weight:500;font-size:50px;line-height:50px;font-family:"Open Sans";background-color:#ffffffa1;padding:0px 50px;-webkit-border-radius:0px;-moz-border-radius:0px;border-radius:0px}</style>

            <script type="text/javascript">
                /******************************************
                    -	PREPARE PLACEHOLDER FOR SLIDER	-
                ******************************************/

                var setREVStartSize = function() {
                    var	tpopt = new Object();
                        tpopt.startwidth = 960;
                        tpopt.startheight = 350;
                        tpopt.container = jQuery('#rev_slider_2_1');
                        tpopt.fullScreen = "on";
                        tpopt.forceFullWidth="off";

                    tpopt.container.closest(".rev_slider_wrapper").css({height:tpopt.container.height()});tpopt.width=parseInt(tpopt.container.width(),0);tpopt.height=parseInt(tpopt.container.height(),0);tpopt.bw=tpopt.width/tpopt.startwidth;tpopt.bh=tpopt.height/tpopt.startheight;if(tpopt.bh>tpopt.bw)tpopt.bh=tpopt.bw;if(tpopt.bh<tpopt.bw)tpopt.bw=tpopt.bh;if(tpopt.bw<tpopt.bh)tpopt.bh=tpopt.bw;if(tpopt.bh>1){tpopt.bw=1;tpopt.bh=1}if(tpopt.bw>1){tpopt.bw=1;tpopt.bh=1}tpopt.height=Math.round(tpopt.startheight*(tpopt.width/tpopt.startwidth));if(tpopt.height>tpopt.startheight&&tpopt.autoHeight!="on")tpopt.height=tpopt.startheight;if(tpopt.fullScreen=="on"){tpopt.height=tpopt.bw*tpopt.startheight;var cow=tpopt.container.parent().width();var coh=jQuery(window).height();if(tpopt.fullScreenOffsetContainer!=undefined){try{var offcontainers=tpopt.fullScreenOffsetContainer.split(",");jQuery.each(offcontainers,function(e,t){coh=coh-jQuery(t).outerHeight(true);if(coh<tpopt.minFullScreenHeight)coh=tpopt.minFullScreenHeight})}catch(e){}}tpopt.container.parent().height(coh);tpopt.container.height(coh);tpopt.container.closest(".rev_slider_wrapper").height(coh);tpopt.container.closest(".forcefullwidth_wrapper_tp_banner").find(".tp-fullwidth-forcer").height(coh);tpopt.container.css({height:"100%"});tpopt.height=coh;}else{tpopt.container.height(tpopt.height);tpopt.container.closest(".rev_slider_wrapper").height(tpopt.height);tpopt.container.closest(".forcefullwidth_wrapper_tp_banner").find(".tp-fullwidth-forcer").height(tpopt.height);}
                };

                /* CALL PLACEHOLDER */
                setREVStartSize();

                var tpj=jQuery;
                tpj.noConflict();
                var revapi2;

                tpj(document).ready(function() {

                if(tpj('#rev_slider_2_1').revolution == undefined){
                    revslider_showDoubleJqueryError('#rev_slider_2_1');
                }else{
                   revapi2 = tpj('#rev_slider_2_1').show().revolution(
                    {	
                        dottedOverlay:"none",
                        delay:5000,
                        startwidth:960,
                        startheight:350,
                        hideThumbs:200,
                        thumbWidth:100,
                        thumbHeight:50,
                        thumbAmount:2,
                        simplifyAll:"off",
                        navigationType:"none",
                        navigationArrows:"solo",
                        navigationStyle:"round",
                        touchenabled:"on",
                        onHoverStop:"on",
                        nextSlideOnWindowFocus:"off",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        drag_block_vertical: false,
                        keyboardNavigation:"off",
                        navigationHAlign:"center",
                        navigationVAlign:"bottom",
                        navigationHOffset:0,
                        navigationVOffset:20,
                        soloArrowLeftHalign:"left",
                        soloArrowLeftValign:"center",
                        soloArrowLeftHOffset:20,
                        soloArrowLeftVOffset:0,
                        soloArrowRightHalign:"right",
                        soloArrowRightValign:"center",
                        soloArrowRightHOffset:20,
                        soloArrowRightVOffset:0,
                        shadow:2,
                        fullWidth:"off",
                        fullScreen:"on",
                        spinner:"spinner0",
                        stopLoop:"off",
                        stopAfterLoops:-1,
                        stopAtSlide:-1,
                        shuffle:"off",
                        forceFullWidth:"off",
                        fullScreenAlignForce:"on",
                        minFullScreenHeight:"",
                        hideThumbsOnMobile:"off",
                        hideNavDelayOnMobile:1500,
                        hideBulletsOnMobile:"off",
                        hideArrowsOnMobile:"off",
                        hideThumbsUnderResolution:0,
                        fullScreenOffsetContainer: "",
                        fullScreenOffset: "",
                        hideSliderAtLimit:0,
                        hideCaptionAtLimit:0,
                        hideAllCaptionAtLilmit:0,
                        startWithSlide:0					});
                                    }
                });	/*ready*/
            </script>


            <style type="text/css">
                @media screen and (min-width: 1200px) {
                .flex-direction-nav .flex-next, .flex-direction-nav .flex-prev, .rev_slider_wrapper .tparrows.tp-leftarrow, .rev_slider_wrapper .tparrows.tp-rightarrow {
                    width: 50px;
                    height: 50px!important;
                    background-size: 50px 100px;
                    margin-top: -50px;
                    }
                }
                @media screen and (min-width: 800px) {
                .flex-direction-nav .flex-next, .flex-direction-nav .flex-prev, .rev_slider_wrapper .tparrows.tp-leftarrow, .rev_slider_wrapper .tparrows.tp-rightarrow {
                    width: 40px;
                    height: 40px!important;
                    background-size: 40px 80px;
                    margin-top: -40px;
                    }
                }
            </style>
        </div><!-- END REVOLUTION SLIDER -->		
    </div>
    <a id="scroll-down" class="scroll" href="#main"></a>
</header><!-- #masthead -->