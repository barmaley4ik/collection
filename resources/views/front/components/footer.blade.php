<footer id="colophon" class="site-footer" role="contentinfo">
  
    <div class="footer-inner clearfix">
        <section id="tertiary" class="sidebar-footer">
            <div class="sidebar-inner wrap">
                <div class="widget-area">
                    <aside id="text-5" class="widget widget_text">
                        <div class="widget-content">
                            <div class="textwidget">
                                <div class="aligncenter">
                                    <div class="vertical-space1"></div>
                                <img class="lazy lazy-hidden" src="{{ secure_asset('css/images/lazy_placeholder.gif') }}" data-lazy-type="image" data-src="{{ $setting->logo }}" alt="{{ $festival->name }}">
                                    <noscript><img src="{{ $setting->logo }}" alt="{{ $festival->name }}"></noscript>
                                    <div class="vertical-space1"></div>
                                    <div class="logo_association">
                                    <img class="lazy lazy-hidden" src="{{ secure_asset('css/images/lazy_placeholder.gif') }}" data-lazy-type="image" data-src="{{ $setting->footer_logo_second }}" >
                                        <noscript><img src="{{ $setting->footer_logo_second }}" ></noscript>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                                        
                    <aside id="text-6" class="widget widget_text">
                        <div class="widget-content">
                        <h3 class="widget-title">Мы на Instagram</h3>
                            <div class="textwidget">
                                {{-- <div id="sb_instagram"> --}}
{{--                                 <div id="sb_instagram" class="sbi sbi_mob_col_auto sbi_col_3" style="width:100%; padding-bottom: 10px; " data-id="1964825845" data-num="9" data-res="auto" data-cols="3" data-options='{&quot;sortby&quot;: &quot;none&quot;, &quot;showbio&quot;: &quot;true&quot;, &quot;headercolor&quot;: &quot;&quot;, &quot;imagepadding&quot;: &quot;5&quot;, &quot;disablecache&quot;: &quot;false&quot;, &quot;sbiCacheExists&quot;: &quot;true&quot;, &quot;sbiHeaderCache&quot;: &quot;true&quot;}'>     --}}                               <div id="instagram-feed1"></div> 
{{--                                     <div id="sbi_images" style="padding: 5px;">
                                        <div class="sbi_loader fa-spin"></div>
                                    </div> --}}
                                    {{-- <div id="sbi_load" style="padding: 5px;"> --}}
{{--                                         <a class="sbi_load_btn" href="javascript:void(0);" style="">
                                            <span class="sbi_btn_text">Загрузи больше...</span>
                                            <i class="fa fa-spinner fa-pulse" aria-hidden="true" style="display:none;"></i>
                                        </a> --}}
                                      
                                        <div class="button" style="background: #517fa4;padding: 5px;color: #fff;border: none;width: 97%;">
                                            <a href="{{ $socials['instagram']['url'] }}" style="color: #fff;  border: none;" target="_blank">
                                                <i class="fa fab fa-instagram" style="color: white"></i>
                                            <span style="color: white">перейти в Instagram </span>
                                            </a>
                                        </div>
                                    {{-- </div> --}}
                                </div>
                            {{-- </div> --}}
                        </div>
                    </aside>
                    <aside id="like_box_widget_facbook-3" class="widget like_box_widget_facbook">
                        <div class="widget-content">
                            <h3 class="widget-title">Мы на facebook</h3>
                            <div class="fb-page" data-href="{{ $socials['facebook']['url'] }}" data-width="250" data-height="310" data-small-header="false" data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="true" data-show-posts="true">
                                <div class="fb-xfbml-parse-ignore">
                                    <blockquote cite="{{ $socials['facebook']['url'] }}">
                                        <a href="{{ $socials['facebook']['url'] }}"></a>
                                    </blockquote>
                                </div>
                            </div>
{{--                             <div style="font-size:2px;width:2px;height:1px;overflow: hidden;">
                                <a href="https://wordpress.org/plugins/contact-forms-builder">WordPress Contact Form</a>
                            </div> --}}
                            <div id="fb-root"></div>

                            <script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, "script", "facebook-jssdk"));</script>
                        </div>
                    </aside>
                </div>
            </div>
        </section><!-- #tertiary .sidebar-footer -->
        <div class="footer-end wrap" style="display: flex;">
            <div class='theme-socials-container text-center'style="flex: auto;">
                <a href='{{ $socials['facebook']['url'] }}' title='facebook' target='_blank' class='wolf-social-link'>
                    <span class='wolf-social fa fa-facebook normal wolf-social-1x hover-none wolf-social-no-custom-style'></span>
                </a>
                <a href='{{ $socials['instagram']['url'] }}' title='instagram' target='_blank' class='wolf-social-link'>
                    <span class='wolf-social fa fa-instagram normal wolf-social-1x hover-none wolf-social-no-custom-style'></span>
                </a>
                <a href='{{ $socials['youtube']['url'] }}' title='youtube' target='_blank' class='wolf-social-link'>
                    <span class='wolf-social fa fa-youtube normal wolf-social-1x hover-none wolf-social-no-custom-style'></span>
                </a>
            </div><!-- .theme-socials-container -->			
        </div>
    </div>
    <div class="clear"></div>
    <div class="site-infos text-center clearfix">All rights reserved. Tattoo Collection 2020</div>	
    <script>
        (function(){
            new InstagramFeed({
                'username': 'tattoo_collection_kiev',
                'container': document.getElementById("instagram-feed1"),
                'display_profile': false,
                'display_biography': false,
                'display_gallery': true,
                'callback': null,
                'styling': true,
                'items': 9,
                'items_per_row': 3,
                'margin': 2 
            });
        })();
    </script>      
</footer><!-- footer#colophon .site-footer -->