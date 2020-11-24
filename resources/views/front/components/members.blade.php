@if(count($festival->membersRandom)>0)
<div style="background-color:#808080;background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" id="members" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width  news_block">
    <div class='wolf-row-inner' style='padding-top:0px;padding-bottom:0px;'>
        <div class="wrap">
            <div class="col-12   wolf-col">
                <div class="wpb_wrapper">
                    <h5 style='line-height:1;font-weight:500;letter-spacing:0px;text-transform:uppercase;color:#ffffff; line-height: 2.5; padding-top: 30px; margin-bottom: 0px; padding-bottom: 30px;' class='fittext text-center clearfix wow fadeIn' data-max-font-size='24'>{{ __('front.members') }}</h5>
                </div> 
            </div> 
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->
@foreach ($festival->membersRandom->chunk(4) as $chunk)
<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width ">
    <div class='wolf-row-inner' style='padding-top:2px;padding-bottom:0px;'>
        <div class="wrap">
            @foreach ($chunk as $member)
            <div class="col-3 wolf-col">
                <div class="wpb_wrapper">
                    <div class='team-member-container text-center wow fadeInUp'>
                        <div class='team-member-photo'>
                        <a href="{{ $isDomain ? localized_route('fest.member',['member' => $member, 'domain' => $domainParam]) : localized_route('member',['member' => $member]) }}" title="{{ \Illuminate\Support\Str::title($member->name) }}" target='_self'>
                        <img class="lazy lazy-hidden" src="{{ asset('css/images/lazy_placeholder.gif') }}" data-lazy-type="image" data-src='{{ $member->logo }}' alt='{{ $member->name }}'>
                                <noscript><img src='{{ $member->logo }}' alt='{{ $member->name }}'></noscript>
                            </a>
                        </div>
                        <h6 class='team-member-name'>{{ $member->name }}</h6>
                        @php
                            $social = json_decode($member->social);
                        @endphp
                        <div class="team-member-social-container">
                            <a href='{{ $member->country->logo ?? ''}}' style="pointer-events: none;" title='{{__('front.country')}}' target='_blank'>
                            <img src="{{ $member->country->logo ?? ''}}" alt="{{__('front.country')}}" title="{{__('front.country')}}" width="24" height="24" style="vertical-align: sub;"></a>
                            @if ($social->facebook)
                            <a href='{{ $social->facebook }}' class='fa fa-facebook' title='facebook' target='_blank'></a>   
                            @endif

                            @if ($social->email)
                            <a href='mailto:{{ $social->email }}' class='fa fa-envelope' title='mail' target='_blank'></a>  
                            @endif

                            @if ($social->instagram)
                            <a href='{{ $social->instagram }}' class='fa fa-instagram' title='instagram' target='_blank'></a>   
                            @endif
                            
                            @if ($social->website)
                            <a href='{{ $social->website }}' class='fa fa-globe' title='web' target='_blank'></a>   
                            @endif  
                        </div>
                    </div>
                    <div class='buttons-container wow fadeIn text-center' style='margin-top:5px;'>
                        <span class='button-container'>
                            <a class='wolf-button medium square icon_after accent-color' href='{{ $isDomain ? localized_route('fest.member',['member' => $member, 'domain' => $domainParam]) : localized_route('member',['member' => $member]) }}' target='_self'>{{ __('front.more') }}</a>
                        </span>
                    </div>
                </div> 
            </div>
            @endforeach 
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->
@endforeach
<div class='buttons-container wow fadeIn text-center' style='margin-top:20px;'>
    <span class='button-container'>
        <a class='wolf-button medium square icon_after accent-color' href='{{ $isDomain ? localized_route('fest.allmembers',[$domainParam]) : localized_route('allmembers') }}' target='_self'>{{ __('front.more_all') }}</a>
    </span>
</div>
@endif