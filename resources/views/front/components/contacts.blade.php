{{-- @if ((! count(request()->segments()) || request()->segment(0)=== 'en' || request()->segment(0)=== 'ua') && (request()->segment(1)== null)) --}}
    
  
<div style="background-color:#808080;background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" id="contacts" class="wpb_row section wolf-row clearfix content-light-font wolf-row-full-width ">
    <div class='wolf-row-inner' style='padding-top:0px;padding-bottom:0px;'>
        <div class="wrap">
            <div class="col-12 wolf-col">
                <div class="wpb_wrapper">
                <h5 style='line-height:1;font-weight:500;letter-spacing:0px;text-transform:uppercase;color:#ffffff; line-height: 2.5; padding-top: 30px; margin-bottom: 5px; padding-bottom: 30px; background-color:#808080;' class='fittext text-center clearfix wow fadeIn' data-max-font-size='24'> {{ __('front.contacts')}}</h5>
                </div> 
            </div> 
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->
{{-- @endif --}}
<div style="background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-full-width section-full-screen ">
    <div class='wolf-row-inner' style='padding-top:0px;padding-bottom:0px;'>
        <div class="wrap">
            <div class="col-12 wolf-col">
                <div class="wpb_wrapper">
                    <div class="wpb_gmaps_widget wpb_content_element">
                        <div class="wpb_wrapper">
                            <div class="wpb_map_wraper">
                            <iframe class="lazy lazy-hidden" data-lazy-type="iframe" data-src="{{ $festival->google_map_coordinates }}" width="600" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                                <noscript>
                                    <iframe src="{{ $festival->google_map_coordinates }}" width="600" height="400" frameborder="0" style="border:0;" allowfullscreen="">
                                    </iframe>
                                </noscript>
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->

{{-- <div style="background-color:#808080;background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width  contact">
    <div class='wolf-row-inner' style='padding-top:10px;padding-bottom:10px;'>
        <div class="wrap">
            <div class="col-4 wolf-col">
                <div class="wpb_wrapper">
                    <div class="wpb_text_column wpb_content_element ">
                        <div class="wpb_wrapper">
                            <p style="text-align: center;"><strong>{{ __('front.place_convencii')}}:</strong>
                                <br/>
                                {{ $festival->adress }}
                            </p>
                        </div> 
                    </div> 
                </div> 
            </div> 
            <div class="col-4 wolf-col">
                <div class="wpb_wrapper">
                    <div class="wpb_text_column wpb_content_element ">
                        <div class="wpb_wrapper">
                            <p style="text-align: center;">
                                <strong>{{ __('front.supervizor')}}:</strong>
                                <br/>
                                @php
                                   $object = json_decode($festival->supervisor_project); 
                                   $name = (array)$object->name;
                                @endphp
                                {{ $name[app()->getLocale()] }} 
                            </p>
                            <p style="text-align: center;"><strong>{{ __('front.sponsor')}}:</strong>
                                <br/>
                                @php
                                   $object = json_decode($festival->supervisor_sponsors); 
                                   $name = (array)$object->name;
                                   $email = $object->email;
                                @endphp
                                {{ $name[app()->getLocale()] }} 
                                <br/>
                                {{ $email }} 
                            </p>
                            <p style="text-align: center;"><strong>{{ __('front.members_work')}}:</strong>
                                <br/>
                                @php
                                   $object = json_decode($festival->supervisor_members); 
                                   $name = (array)$object->name;
                                   $email = $object->email;
                                @endphp
                                {{ $name[app()->getLocale()] }} 
                                <br/>
                                {{ $email }} 
                            </p> 
                        </div> 
                    </div> 
                </div> 
            </div> 
            <div class="col-4 wolf-col">
                <div class="wpb_wrapper">
                    <div class="wpb_text_column wpb_content_element ">
                        <div class="wpb_wrapper">
                            <p style="text-align: center;"><strong>{{ __('front.contact_phones')}}:</strong><br/>
                            @php
                                $phones = json_decode($festival->phones); 
                            @endphp
                            @foreach ($phones as $phone)
                                @if ($loop->last)
                                    {{ $phone }}
                                @else
                                    {{ $phone }},
                                @endif
                            @endforeach
                            </p>
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div><!--.wrap-->
    </div><!--.wolf-row-inner-->
</div><!--.wolf-row-->
 --}}
{{-- example --}}

<div style="background-color:#808080;background-position:center center;background-repeat:no-repeat;-webkit-background-size: 100%; -o-background-size: 100%; -moz-background-size: 100%; background-size: 100%;-webkit-background-size: cover; -o-background-size: cover; background-size: cover;" class="wpb_row section wolf-row clearfix content-light-font wolf-row-standard-width  contact">
    <div class='wolf-row-inner' style='padding-top:10px;padding-bottom:10px;'>
        <div class="wrap">
            <div class="col-3 wolf-col">
                <div class="wpb_wrapper">
                    <div class="wpb_text_column wpb_content_element ">
                        <div class="wpb_wrapper">
                            <p style="text-align: center;">
                                <strong>{{ __('front.place_convencii')}}:</strong>
                                <br/>
                            </p>
                            <p style="text-align: justify;">
                                {{ $festival->adress }}
                            </p>
                            <p style="text-align: center;"><strong>{{ __('front.contact_phones')}}:</strong><br/>
                                @php
                                    $phones = json_decode($festival->phones); 
                                @endphp
                                @foreach ($phones as $phone)
                                    @if ($loop->last)
                                        {{ $phone }}
                                    @else
                                        {{ $phone }},
                                    @endif
                                @endforeach
                            </p>
                                                        
                        </div> 
                    </div> 
                </div>
            </div>
            <div class="col-3 wolf-col">
                <div class="wpb_wrapper">
                    <div class="wpb_text_column wpb_content_element ">
                        <div class="wpb_wrapper">
                            @php
                            $object = json_decode($festival->supervisor_project); 
                            $name = (array)$object->name;
                            $photo = $object->photo;
                            @endphp
                            <header style="text-align: center">
                                <a target="_blank" href="#">
                                <img style="width: 150px; display: inline-block" src=" {{ asset($photo) }}">
                                </a>
                                <h1 style="font-size: 20px">{{ $name[app()->getLocale()] }} </h1>
                                <h2 style="font-size: 16px; min-height: 34px">{{ __('front.supervizor')}}</h2>
                            </header>                            
                        </div>                        
                    </div>
                </div>  
            </div>
            <div class="col-3 wolf-col">
                <div class="wpb_wrapper">
                    <div class="wpb_text_column wpb_content_element ">
                        <div class="wpb_wrapper">
                            @php
                            $object = json_decode($festival->supervisor_sponsors); 
                            $name = (array)$object->name;
                            $photo = $object->photo;
                            $email = $object->email;
                            @endphp
                            <header style="text-align: center">
                                <a target="_blank" href="#">
                                <img style="width: 150px; display: inline-block" src=" {{ asset($photo) }}">
                                </a>
                                <h1 style="font-size: 20px">{{ $name[app()->getLocale()] }} </h1>
                                <h2 style="font-size: 16px; min-height: 34px">{{ __('front.sponsor')}}</h2>
                                <span> <a style="color: white" href="mailto:{{ $email }}">{{ $email }} </a> </span>
                            </header>                            
                        </div>
                    </div>
                </div>  
            </div>
            <div class="col-3 wolf-col">
                <div class="wpb_wrapper">
                    <div class="wpb_text_column wpb_content_element ">
                        <div class="wpb_wrapper">
                            @php
                            $object = json_decode($festival->supervisor_members); 
                            $name = (array)$object->name;
                            $photo = $object->photo;
                            $email = $object->email;
                            @endphp
                            <header style="text-align: center">
                                <a target="_blank" href="#">
                                <img style="width: 150px; display: inline-block" src=" {{ asset($photo) }}">
                                </a>
                                <h1 style="font-size: 20px">{{ $name[app()->getLocale()] }} </h1>
                                <h2 style="font-size: 16px; min-height: 34px">{{ __('front.members_work')}}</h2>
                                <span> <a style="color: white" href="mailto:{{ $email }}">{{ $email }} </a> </span>
                            </header>                            
                        </div>
                    </div>
                </div>  
            </div>                                          
        </div> 
    </div>
</div>
