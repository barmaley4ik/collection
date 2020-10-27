						<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-dark-font wolf-row-full-width ">
							<div class="wolf-row-inner" style="padding-top:50px;padding-bottom:0px;">
								<div class="wrap">
									<div class="col-12   wolf-col alpha">
										<div class="wpb_wrapper">
											<div class="wpb_text_column wpb_content_element ">
												<div class="wpb_wrapper">
													<h2 style="text-align: center;"><span> {{ __('front.portfolio_member')}} </span></h2>
												</div> 
											</div>
											<div class="vc_empty_space" style="height: 50px">
												<span class="vc_empty_space_inner"></span>
											</div>
											<style type="text/css"> #gallery-534 .block { float: left; width: 33.32%;}</style>
											<div class="wolf-images-gallery clearfix simple-gallery hover-scale-to-greyscale" id="gallery-534">
											@php
												$images= json_decode($member->portfolio);
											@endphp
											@foreach ($images as $image)
												<div class="block">
													<a title="" href="{{ $image }}" class="lightbox image-item" rel="gallery-534">
														<img class="lazy-loaded" src="{{ $image }}" data-lazy-type="image" data-src="{{ $image }}" alt="{{ $member->name }}">
														<noscript><img src='{{ $image }}' alt='{{ $member->name }}'></noscript>
													</a>
												</div>
											@endforeach	
											</div>
										</div> 
									</div> 
								</div><!--.wrap-->
							</div><!--.wolf-row-inner-->
						</div><!--.wolf-row-->