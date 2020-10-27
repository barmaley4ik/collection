<div id="top-bar">
    <div class="wrap">
        <div class="infos-container">
            <div class="dates">
                @php
                    $dataStart = $festival->date_start;
                    $diffDate = $festival->date_start->diffInDays($festival->date_end);
                @endphp    
                @for ($i = 0; $i <= $diffDate; $i++)
                    @if($i != $diffDate)
                        {{$dataStart->addDays($i)->format('d')}}-
{{--                     @else
                        {{$dataStart->addDays($i)->format('d')}} --}}
                    @endif
                @endfor
                @if (request()->segment(1)=== 'ua')
                @php
                    app()->setLocale('uk');
                @endphp
                {{ $festival->date_end->translatedFormat('j F Y') }}
                @php
                    app()->setLocale('ua');
                @endphp
                @else
                {{ $festival->date_end->translatedFormat('j F Y') }}
                @endif
            </div>
            <div class="wolf-flags-container">
                @foreach ($languages as $item)
                    <a href="{{ current_route($item) }}" class="lang-item lang-item-2 ">{{$item}}| </a>
                @endforeach
{{--                 <a href="http://tattoo-collection.kiev.ua/" class="lang-item lang-item-2 lang-item-ru lang-item-first current-lang">ru| </a>
                <a href="http://tattoo-collection.kiev.ua/en/" class="lang-item lang-item-5 lang-item-en">en| </a>
                <a href="http://tattoo-collection.kiev.ua/uk/" class="lang-item lang-item-10 lang-item-uk">uk| </a> --}}
            </div>
        </div>
        @include('front.components.socials')
    </div>
</div>