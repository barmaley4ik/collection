<div id="mobile-bar" class="clearfix">
    <div id="mobile-bar-inner">
        <div id="menu-toggle" class="menu-toggle">
            <div class="burger-before"></div>
            <div class="burger"></div>
            <div class="burger-after"></div>
        </div>
        <div class="logo">
            <a href="{{ $isDomain ? localized_route('fest.home',[$domainParam]) : localized_route('home') }}" rel="home">
                <img class="logo-dark" src="{{ $setting->logo ?? ''}}" alt="{{ $setting->name ?? '' }}">
                <img class="logo-light" src="{{ $setting->logo ?? ''}}" alt="{{ $setting->name ?? '' }}">
            </a>
        </div>
    </div>
</div>
<div id="navbar-mobile-container">
    <div id="navbar-mobile" class="navbar clearfix">
        <nav id="site-navigation-primary-mobile" class="navigation main-navigation clearfix" role="navigation">
            <div class="menu-main_ru-container">
                <ul id="mobile-menu" class="nav-menu dropdown">
                    @foreach ($menus as $item)
                    <li class="menu-item menu-item-type-custom menu-item-object-custom {{ isset($item['submenu']) ? 'menu-item-has-children' : '' }}  menu-item-{{ $loop->index }} sub-menu-dark menu-item-icon-before">
                        <a href="{{ $item['url'] }}">
                            <span>{{ $item['title'] }}</span>
                        </a>
                        @isset($item['submenu'])
                        <ul class="sub-menu">
                            @foreach ($item['submenu'] as $subItem)
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-{{ $loop->index }} sub-menu-dark menu-item-icon-before">
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
</div>