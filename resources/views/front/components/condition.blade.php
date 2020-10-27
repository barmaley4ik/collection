<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width ">
	<div class='wolf-row-inner' style='padding-top:20px;padding-bottom:20px;'>
		<div class="wrap">
			<div class="col-8   wolf-col">
				<div class="wpb_wrapper">
					<div class="wpb_text_column wpb_content_element ">
						<div class="wpb_wrapper">
						{!! $festival->condition->description !!}
						</div> 
					</div> 
				</div> 
			</div> 

			<div class="col-4   wolf-col">
				<div class="wpb_wrapper">
					<div class="vc_empty_space" style="height: 32px">
						<span class="vc_empty_space_inner"></span>
					</div>
					<span class='button-container'>
					<a class='wolf-button large square icon_after border-button-accent-hover' href='{{ $isDomain ? localized_route('fest.proposal-member',['domain' => $domainParam]) : localized_route('proposal-member') }}' target='_self'>{{ __('front.fill_form')}}</a>
					</span>
					<span class='button-container'>
						<a class='wolf-button large square icon_after border-button-accent-hover' href='' target='_self'>{{ __('front.fill_form_tm')}}</a>
						</span>					
					<div class="vc_empty_space" style="height: 32px">
						<span class="vc_empty_space_inner"></span>
					</div>
				</div> 
			</div> 
		</div><!--.wrap-->
	</div><!--.wolf-row-inner-->
</div><!--.wolf-row-->