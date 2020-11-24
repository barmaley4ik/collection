						<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width ">
							<div class="wolf-row-inner" style="padding-top:5px;padding-bottom:5px;">
								<div class="wrap">
									@php
										$prev= $member->previous();
										$next = $member->next();
									@endphp
									@if($prev)
									<div class="col-6 wolf-col alpha">
										<div class="wpb_wrapper">
											<div class="buttons-container text-left">
												<span class="button-container">
													<a class="wolf-button medium square icon_after accent-color" href="{{ $isDomain ? localized_route('fest.member',['member' => $prev, 'domain' => $domainParam]) : localized_route('member',['member' => $prev])  }}" target="_self">{{ __('front.prev_member') }}</a>
												</span>
											</div>
										</div> 
									</div>
									@else
									<div class="col-6 wolf-col alpha">
										<div class="wpb_wrapper">
											<div class="buttons-container text-left">
												<span class="button-container">
													<a class="wolf-button medium square icon_after accent-color" style="pointer-events: none;" href="#" target="_self">{{ __('front.prev_member') }}</a>
												</span>
											</div>
										</div> 
									</div>									
									@endif
									@if($next) 
									<div class="col-6 wolf-col">
										<div class="wpb_wrapper">
											<div class="buttons-container text-right">
												<span class="button-container">
													<a class="wolf-button medium square icon_after accent-color" href="{{ $isDomain ? localized_route('fest.member',['member' => $next, 'domain' => $domainParam]) : localized_route('member',['member' => $next]) }}" target="_self">{{ __('front.next_member') }}</a>
												</span>
											</div>
										</div> 
									</div>
									@else
									<div class="col-6 wolf-col">
										<div class="wpb_wrapper">
											<div class="buttons-container text-right">
												<span class="button-container">
													<a class="wolf-button medium square icon_after accent-color" style="pointer-events: none;" href="#" target="_self">{{ __('front.next_member') }}</a>
												</span>
											</div>
										</div> 
									</div>									
									@endif 
								</div><!--.wrap-->
							</div><!--.wolf-row-inner-->
						</div><!--.wolf-row-->
						<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix  wolf-row-full-width">
							<div class="wolf-row-inner no-padding">
								<div class="wrap">
									<div class="col-12 wolf-col alpha">
										<div class="wpb_wrapper">
											<section class="holder clearfix holder-2-cols">
												<div class="holder-element holder-content-text content-light-font" style="background:url({{url('storage/background/broken_noise.jpg')}});">
													<div class="holder-element-inner">
														<div class="holder-text-element-inner">
															<div class="wpb_text_column wpb_content_element ">
																<div class="wpb_wrapper">
																	<h2 style="text-align: center;">{{ $member->name }}</h2>
																	@php
																		$social = json_decode($member->social);
																	@endphp
																	<p> 
																		{{ __('front.country_city') }}: {{ $member->country->name ?? '' }}, {{ $member->city ?? '' }}
																		@if ($member->place_number)
																		<br>
																			{{ __('front.member_place') }}: {{ $member->place_number }}
																		@endif																		
																	</p>
																	<p>
																		{{ __('front.studio_label') }}: {{ $member->studio }}
																		@if ($social->website)
																		<br>
																		Website: <a href="{{ $social->website }} ">{{ $social->website }}</a>	
																		@endif

																		@if ($social->facebook)
																		<br>
																		Facebook: <a href="{{ $social->facebook }} ">{{ $social->facebook }}</a>	
																		@endif																		
		
																		@if ($social->instagram)
																		<br>
																		Instagram: <a href="{{ $social->instagram }} ">{{ $social->instagram }}</a>	
																		@endif
																																					
																		@if ($social->email)
																		<br>
																		E-mail: <a href="{{ $social->email }} ">{{ $social->email }}</a>	
																		@endif									
																	</p>
																</div> 
															</div>
														</div>
													</div>
												</div>
												<div class="holder-element holder-content-light content-light-font">
													<div class="holder-element-inner">
														<div class="wolf-single-image text-center hover-none default">
															<span class="image-item">
																<img src="{{ $member->logo }}" data-lazy-type="image" data-src="{{ $member->logo }}" alt="{{ $member->name }}" class="lazy-loaded">
																<noscript>
																	<img src='{{ $member->logo }}' alt='{{ $member->name }}'>
																</noscript>
															</span>
														</div>
													</div>
												</div>
											</section>
										</div> 
									</div> 
								</div><!--.wrap-->
							</div><!--.wolf-row-inner-->
						</div><!--.wolf-row-->