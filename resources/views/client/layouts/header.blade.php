<nav id="tm-header" class="uk-navbar  ">
    <div class="uk-container uk-container-center ">
        <a class="uk-navbar-brand uk-hidden-small" href="{{ route('index') }}"><i class="uk-icon-small uk-text-primary uk-margin-small-right uk-icon-play-circle"></i> {{ __('label.title_header') }}</a>
        
        <form class="uk-search uk-margin-small-top uk-margin-left uk-hidden-small">
            <input class="uk-search-field" type="search" placeholder="{{ __('label.search') }}" autocomplete="off">
            <div class="uk-dropdown uk-dropdown-flip uk-dropdown-search" aria-expanded="false">
            </div>
        </form>
        <div class="uk-navbar-flip uk-hidden-small">
            <div class="uk-button-group">
                @guest
                    @if (Route::has('register'))
                        <a class="uk-button uk-button-link uk-button-large" href="{{ route('register') }}">{{ __('label.sign_up') }}</a>
                    @endif
                    <a class="uk-button uk-button-success uk-button-large uk-margin-left" href="{{ route('login') }}"><i class="uk-icon-lock uk-margin-small-right"></i> {{ __('label.log_in') }}</a>
                @endguest
            </div>
        </div>
        <a href="#offcanvas" class="uk-navbar-toggle uk-visible-small uk-icon-medium" data-uk-offcanvas></a>
        <div class="uk-navbar-flip uk-visible-small">
            <a href="#offcanvas" class="uk-navbar-toggle uk-navbar-toggle-alt uk-icon-medium" data-uk-offcanvas></a>
        </div>
        <div class="uk-navbar-brand uk-navbar-center uk-visible-small">
            <i class="uk-icon-small uk-text-primary uk-margin-small-right uk-icon-play-circle"></i> {{ __('label.title_header') }}
        </div>  
    </div>
</nav>
<nav class="uk-navbar uk-navbar-secondary uk-hidden-small">
    <div class="uk-container-center uk-container">
        <ul class="uk-navbar-nav">
            {{-- <li class="uk-active"><a href="#">{{ __('label.home') }}</a></li> --}}
            <li><a href="{{ route('index') }}">{{ __('label.home') }}</a></li>
            @foreach ($menus as $menu)
                @if ($menu->childMenu->count() > 0)
                    <li class="uk-parent" data-uk-dropdown>
                        <a href="#">{{ $menu->name }}
                            <i class="uk-icon-angle-down uk-margin-small-left"></i>
                        </a>
                        <div class="uk-dropdown uk-dropdown-navbar">
                            <ul class="uk-nav uk-nav-navbar">
                                @foreach ($menu->childMenu as $child)
                                    <li><a href="{{ route('showfilmbymenu', ['id' => $child->id]) }}">{{ $child->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @else
                    <li><a class="point" href="{{ route('showfilmbymenu', ['id' => $menu->id]) }}">{{ $menu->name }}</a></li>
                @endif              
            @endforeach
        </ul>
        <div class="uk-navbar-flip">
            <ul class="uk-navbar-nav">
                @if (Auth::check())
                
                <li class="uk-parent" data-uk-dropdown>
                    <a href="#">{{ __('label.hello') }} {{ Auth::user()->full_name }} <span class="caret"></span>
                        <i class="uk-icon-angle-down uk-margin-small-left"></i>
                    </a>
                    <div class="uk-dropdown uk-dropdown-navbar">
                        <ul class="uk-nav uk-nav-navbar">
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                            @if (Auth::user()->role_id > 0)
                                <li>
                                    <a href="{{ route('dashboard') }}">{{ __('label.manage') }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>

                @endif
            </ul>
        </div>
    </div>
</nav>
