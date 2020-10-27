<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width ">
	<div class='wolf-row-inner' style='padding-top:20px;padding-bottom:20px;'>
		<div class="wrap">
			<div class="col-8 wolf-col">
				<div class="wpb_wrapper">
					<div class="wpb_text_column wpb_content_element ">
						<div class="wpb_wrapper">
						{!! $partner->description ?? '' !!}
						</div> 
					</div> 
				</div> 
			</div> 
			<div class="col-4 wolf-col">
				<div class="wpb_wrapper">
					<span class='button-container' style="width: 360px; height: 360px; background-image: url({{ $partner->logo ?? '' }}); display:block" />
				</div> 
			</div> 
		</div><!--.wrap-->
	</div><!--.wolf-row-inner-->
</div><!--.wolf-row-->