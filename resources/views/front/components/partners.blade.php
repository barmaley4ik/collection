@if ((! count(request()->segments()) || request()->segment(0)=== 'en' || request()->segment(0)=== 'ua') && (request()->segment(1)== null))
<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" id="partners" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width ">
    <div class='wolf-row-inner' style='padding-top:20px;padding-bottom:20px;'>
        <div class="wrap">
            <div class="col-12 wolf-col">
                <div class="wpb_wrapper">
                <h5 style='line-height:1;font-weight:600;letter-spacing:0px;text-transform:uppercase;color:#ffffff;' class='fittext text-center clearfix wow fadeIn' data-max-font-size='30'>{{ __('front.partners')}}</h5>
                </div> 
            </div> 
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->
@endif
<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width ">
    <div class='wolf-row-inner' style='padding-top:2px;padding-bottom:2px;'>
        <div class="wrap">
            <div class="col-12 wolf-col">
                <div class="wpb_wrapper">
                    <div class='wolf-images-gallery clearfix carousel-simple-gallery owl-carousel hover-default' id='gallery-916'>
                        @foreach ($festival->partners as $partner)
                        <div class='block'>
                            <a href="{{ $isDomain ? localized_route('fest.partner',['partner' => $partner, 'domain' => $domainParam]) : localized_route('partner',['partner' => $partner]) }}">
                                <span class='image-item'><img class="lazy lazy-hidden" src="{{ asset('css/images/lazy_placeholder.gif') }}" data-lazy-type="image" data-src='{{ $partner->logo ?? ''}} ' alt='{{ $partner->name }}'>
                                    <noscript><img src='{{ $partner->logo ?? '' }}' alt='{{ $partner->name }}'></noscript>
                                </span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div> 
            </div> 
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->