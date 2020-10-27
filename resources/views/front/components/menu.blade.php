<div id="ceiling">
    <div id="navbar-container" class="clearfix">
        <div class="wrap">
            <div class="logo">
            <a href="{{ $isDomain ? localized_route('fest.home',[$domainParam]) : localized_route('home') }}" rel="home">
                <img class="logo-dark" src="{{ $setting->logo ?? ''}}" alt="{{ $setting->name ?? '' }}">
                <img class="logo-light" src="{{ $setting->logo ?? ''}}" alt="{{ $setting->name ?? '' }}">
            </a>
            </div>		
            <div id="navbar" class="navbar clearfix">
                <nav class="site-navigation-primary navigation main-navigation clearfix" role="navigation">
                    <div class="menu-main_ru-container">
                        <ul id="menu-main_ru" class="nav-menu">
                            @foreach ($menus as $item)
                                <li id="menu-item-{{ $loop->index }}" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-{{ $loop->index }} sub-menu-dark menu-item-icon-before">
                                <a href="{{ $item['url'] }}">
                                    <span>{{ $item['title'] }}</span>
                                </a>
                                @isset($item['submenu'])
                                <ul class="sub-menu">
                                    @foreach ($item['submenu'] as $subItem)
                                        <li id="menu-item-{{$loop->index}}" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-{{$loop->index}} sub-menu-dark menu-item-icon-before">
                                            <a href="{{ $subItem['url'] }}">
                                                <span>{{ $subItem['title'] }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>   
                                @endisset

                                </li>                                        
                            @endforeach
                        </ul>
                    </div>			
                </nav><!-- #site-navigation-primary -->
            </div><!-- #navbar -->
        </div><!-- .wrap -->
    </div><!-- #navbar-container -->
</div>