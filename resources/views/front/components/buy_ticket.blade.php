<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" id="tickets" class="wpb_row section wolf-row clearfix content-light-font wolf-row-full-width  ticket">
    <div class='wolf-row-inner' style='padding-top:10px;padding-bottom:20px;'>
        <div class="wrap">
            <div class="col-12 wolf-col">
                <div class="wpb_wrapper">
                    <span class='button-container very-large-button-container'>
                    <a style='background-color:#808080;' class='wolf-button wolf-button-custom-style very-large square icon_after' href='{{ $festival->concert_ua_url ?? '' }}' target='_self'>
                        {{ __('front.buy_ticket')}}
                        <i class='fa fa-arrow-right'></i> 
                        </a>
                    </span>
                </div> 
            </div> 
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->