<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-full-width ">
    <div class='wolf-row-inner' style='padding-top:0px;padding-bottom:0px;'>
        <div class="wrap">
            <div class="col-12 wolf-col">
                <div class="wpb_wrapper">
                    <h5 style='line-height:1;font-weight:500;letter-spacing:0px;text-transform:uppercase; line-height: 2.5; padding-top: 30px; margin-bottom: 5px; padding-bottom: 30px; background-color:#808080;' class='fittext text-center clearfix' data-max-font-size='24'>{{ __('front.nominacii') }} </h5>
                </div> 
            </div> 
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->

<div style="background-image:url({{ asset('css/images/background_nominacii_1200_800.jpg') }});background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width  section-parallax">
    <div class='wolf-row-inner' style='padding-top:5px;padding-bottom:5px;'>
        <div class="wrap">
            @foreach ($festival->nominations as $nomination)
            <div class="col-4 wolf-col">
                <div class="wpb_wrapper">
                    <span class='button-container'><a class='wolf-button large square icon_after border-button-accent-hover' href='' target='_self'>{{ $loop->iteration }} {{ __('front.day') }} - {{$nomination->day->translatedFormat('d F Y')}}</a></span>
                    <div class="wpb_text_column wpb_content_element ">
                        <div class="wpb_wrapper">
                          {!! $nomination->text_day !!}  
{{--                             <div><span style="color: #ffffff;">1. Цветная татуировка.</span></div>
                            <div><span style="color: #ffffff;">2. Black &amp; Gray.</span></div>
                            <div><span style="color: #ffffff;">3. Японская классическая/Ориентал.</span></div>
                            <div><span style="color: #ffffff;">4. Best of the day (цветная)</span></div>
                            <div><span style="color: #ffffff;">5. Best of the day (черно-белая)</span></div>
                            <div><span style="color: #ffffff;">6. Best of the day (графика)</span></div>
                            <div class="day"></div> --}}
                        </div> 
                    </div> 
                </div> 
            </div>
            @endforeach 
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->