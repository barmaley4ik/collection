<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" id="programm" class="wpb_row section wolf-row clearfix content-light-font wolf-row-full-width ">
    <div class='wolf-row-inner' style='padding-top:20px;padding-bottom:0px;'>
        <div class="wrap">
            <div class="col-12 wolf-col">
                <div class="wpb_wrapper">
                    <span class='button-container very-large-button-container'>
                    <a style='background-color:#808080;' class='wolf-button wolf-button-custom-style very-large square icon_after' href='{{ $isDomain ? localized_route('fest.program',['domain' => $domainParam]) : localized_route('program') }}' target='_self'>{{ __('front.program-convencii') }}
                            <i class='fa fa-forward'></i> 
                        </a>
                    </span>
                </div> 
            </div> 
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->
@foreach ($festival->programs as $program)
    
    @if ($loop->first)
    <div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width ">
        <div class='wolf-row-inner' style='padding-top:0px;padding-bottom:0px;'>
            <div class="wrap">
                <div class="col-6 wolf-col">
                    <div class="wpb_wrapper">
                        <div class='buttons-container text-center'>
                            <span class='button-container'>
                                <a class='wolf-button large square icon_after border-button' href='' target='_self'>{{ $program->day->translatedFormat('d F Y') }}</a>
                            </span>
                        </div>
                        <div class="wpb_text_column wpb_content_element ">
                            <div class="wpb_wrapper">
                                <p>TBC</p>
                            </div> 
                        </div> 
                    </div> 
                </div> 

                <div class="col-6   wolf-col">
                    <div class="wpb_wrapper">
                        <div class='wolf-single-image text-center hover-none default'><span class='image-item'><img src="{{ asset('css/images/lazy_placeholder.gif') }}" data-lazy-type="image" data-src='{{ asset('css/images/background_program.jpg') }}' alt='{{ __('front.program-convencii') }}' class='lazy lazy-hidden '><noscript><img src='{{ asset('css/images/background_program.jpg') }}' alt='{{ __('front.program-convencii') }}' class=''></noscript></span></div>
                    </div> 
                </div> 
            </div><!--.wrap-->
        </div><!--.wolf-row-inner-->
    </div><!--.wolf-row-->
    <div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width ">
        <div class='wolf-row-inner' style='padding-top:0px;padding-bottom:0px;'>
            <div class="wrap">
    @else
    <div class="col-6 wolf-col">
        <div class="wpb_wrapper">
            <div class='buttons-container text-center'>
                <span class='button-container'>
                    <a class='wolf-button large square icon_after border-button' href='' target='_self'>{{ $program->day->translatedFormat('d F Y') }}</a>
                </span>
            </div>
            <div class="wpb_text_column wpb_content_element ">
                <div class="wpb_wrapper">
                    <p>TBC</p>
                </div> 
            </div> 
        </div> 
    </div> 
    @endif
@endforeach
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->