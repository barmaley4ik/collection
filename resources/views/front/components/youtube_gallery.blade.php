<div style="background-color:#808080;background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" id="gallery" class="wpb_row section wolf-row clearfix content-light-font wolf-row-full-width ">
    <div class='wolf-row-inner' style='padding-top:0px;padding-bottom:0px;'>
        <div class="wrap">
            <div class="col-12   wolf-col">
                <div class="wpb_wrapper">
                <h5 style='line-height:1;font-weight:500;letter-spacing:0px;text-transform:uppercase;color:#ffffff; line-height: 2.5; padding-top: 30px; margin-bottom: 5px; padding-bottom: 30px; background-color:#808080;' class='fittext text-center clearfix wow fadeIn' data-max-font-size='24'>{{ __('front.gallery')}}</h5>
                </div> 
            </div> 
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->

<div style="background-color:#282b2d;background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-dark-font wolf-row-standard-width ">
    <div class='wolf-row-inner' style='padding-top:20px;padding-bottom:20px;'>
        <div class="wrap">
            <div class="col-12 wolf-col">
                <div class="wpb_wrapper">
                <div class='wolf-video-container'><iframe class="lazy lazy-hidden" width="740" height="416" data-lazy-type="iframe" data-src="{{ $festival->video_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <noscript><iframe width="740" height="416" src="{{ $festival->video_url }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></noscript>
                    </div>
                </div> 
            </div> 
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->
<!-- сладер2 -->
<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-full-width ">
    <div class='wolf-row-inner' style='padding-top:2px;padding-bottom:20px;'>
        <div class="wrap">
            <div class="col-12 wolf-col">
                <div class="wpb_wrapper">
                    <div class='wolf-images-gallery clearfix carousel-simple-gallery owl-carousel hover-greyscale' id='gallery-29'>
                        @foreach (json_decode($festival->gallery) as $image)
                        <div class='block'>
                        <a title='{{ __('front.gallery')}}: {{ $festival->name }}' href='{{ $image }}' class='image-item' rel='gallery-29'>
                                <img class="lazy lazy-hidden" src="{{ asset('css/images/lazy_placeholder.gif') }}" data-lazy-type="image" data-src='{{ $image }}' alt='{{ __('front.gallery')}}: {{ $festival->name }}'>
                                <noscript><img src='{{ $image }}' alt='{{ __('front.gallery')}}: {{ $festival->name }}'></noscript>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div> 
            </div> 
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->