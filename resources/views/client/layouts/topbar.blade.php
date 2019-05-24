<nav id="tm-topbar" class=" uk-navbar uk-contrast ">
    <div class="uk-container uk-container-center ">
        <ul class="uk-navbar-nav uk-hidden-small">
            <li class="uk-parent" data-uk-dropdown>
                @if (session('change_language') == 'vi')
                    <a>
                        <i class="uk-icon-small"><span class="flag-icon flag-icon-vn"></span></i>
                    </a>
                @else
                    <a>
                        <i class="uk-icon-small"><span class="flag-icon flag-icon-gb"></span></i>
                    </a>
                @endif
                <div class="uk-dropdown uk-dropdown-custom uk-dropdown-navbar">
                    @if (session('change_language') == 'en' || !session('change_language'))
                        <a href="{{ route('language', ['vi']) }}">
                            <i class="uk-icon-small"><span class="flag-icon flag-icon-vn"></span></i>
                        </a>
                    @else
                        <a href="{{ route('language', ['en']) }}">
                            <i class="uk-icon-small"><span class="flag-icon flag-icon-gb"></span></i>
                        </a>
                    @endif
                </div>
            </li>
            <li>
                <a href="#"><i class="uk-icon-facebook-square uk-icon-small"></i></a>
            </li>
            <li>
                <a href="#"><i class="uk-icon-twitter-square uk-icon-small"></i></a>
            </li>
            
            <li>
                <a href="#"><i class="uk-icon-instagram uk-icon-small"></i></a>
            </li>
            <li>
                <a href="#"><i class="uk-icon-pinterest uk-icon-small"></i></a>
            </li>
            
        </ul>
        <div class="uk-navbar-flip">
            <ul class="uk-navbar-nav uk-hidden-small">
                <li>
                    <a href="#">{{ __('label.terms') }}</a>
                </li>
                
                <li>
                    <a href="#">{{ __('label.policy') }}</a>
                </li>
                <li>
                    <a href="#">{{ __('label.contact') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
