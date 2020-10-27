<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width ">
    <div class='wolf-row-inner' style='padding-top:5px;padding-bottom:5px;'>
        <div class="wrap">
            <div class="col-12   wolf-col">
                <div class="wpb_wrapper">
                    <section class='countdown-container clearfix'>
                        <div class='countdown' id='countdown-51' style='color:#ffffff;'></div>
                    </section>		
                    <script type="text/javascript">

                        jQuery( document ).ready( function() {
                            let y = {{$festival->date_start->format('Y')}};
                            let m = {{$festival->date_start->subMonth()->format('m')}};
                            let d = {{$festival->date_start->format('d')}};                            
                            jQuery( '#countdown-51' ).countdown( {
                                until: new Date(y, m, d),
                                labels: [
                                    WolfThemeParams.years,
                                    WolfThemeParams.months,
                                    WolfThemeParams.weeks,
                                    WolfThemeParams.days,
                                    WolfThemeParams.hours,
                                    WolfThemeParams.minutes,
                                    WolfThemeParams.seconds
                                ],
                                format: 'DHMS',
                                timezone: 2,
                                padZeroes: true
                            } );
                        } );
                    </script>
                </div> 
            </div> 
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->