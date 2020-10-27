<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width ">
	<div class='wolf-row-inner' style=''>
		<div class="wrap">
			<div class="col-12 wolf-col">
				<div class="wpb_wrapper">
					<div class="wpb_text_column wpb_content_element ">
						<div class="wpb_wrapper">
							{!! $festival->hotel->hotel !!}
						</div> 
					</div> 
				</div><!--.wrap-->
			</div>
		</div>
	</div>
</div>
		<!-- Swiper -->
<div class="swiper-container">
	<div class="swiper-wrapper">
		@foreach (json_decode($festival->hotel->images) as $image)
		<div class="swiper-slide" style="background-image:url({{ $image ?? '' }})"></div>
		@endforeach	  
	</div>
	<!-- Add Pagination -->
	<div class="swiper-pagination"></div>
	<!-- Add Arrows -->
	<div class="swiper-button-next"></div>
	<div class="swiper-button-prev"></div>
</div>
<script>
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 3,
      spaceBetween: 30,
      slidesPerGroup: 3,
      loop: true,
      loopFillGroupWithBlank: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
		breakpoints: {
		// when window width is >= 320px
		320: {
		slidesPerView: 1,
		spaceBetween: 20,
		slidesPerGroup: 1,
		},
		// when window width is >= 480px
		480: {
		slidesPerView: 1,
		spaceBetween: 30,
		slidesPerGroup: 1,
		},
		// when window width is >= 640px
		640: {
		slidesPerView: 3,
		spaceBetween: 40,
		slidesPerGroup: 3,
		}
	},	  
});
</script>  