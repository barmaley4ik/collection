
<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width ">
	<div class='wolf-row-inner'>
		<div class="wrap">
			<div class="col-12 wolf-col">
				<div class="wpb_wrapper">
					<h3 style='line-height:1;font-weight:500;letter-spacing:0px;text-transform:uppercase;' class='fittext text-center clearfix' data-max-font-size='36'>{{ $program->day->translatedFormat('d F Y') }}, {{ $program->day->translatedFormat('l') }}</h3>
				</div> 
			</div> 

			<div class="col-12 wolf-col">
				<div class="wpb_wrapper">
					<div class="wpb_text_column wpb_content_element ">
						<div class="wpb_wrapper">
                           {!! $program->text_day !!} 
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>