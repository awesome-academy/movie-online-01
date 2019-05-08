<nav id="tm-header" class="uk-navbar  ">
    <div class="uk-container uk-container-center ">
        <a class="uk-navbar-brand uk-hidden-small" href="{{ route('index') }}"><i class="uk-icon-small uk-text-primary uk-margin-small-right uk-icon-play-circle"></i> {{ __('label.title_header') }}</a>
        <input class="uk-search-field" id="search" type="text" placeholder="{{ __('label.search') }}" autocomplete="off">
        <div class="uk-dropdown uk-dropdown-flip uk-dropdown-search" aria-expanded="false">
        </div>
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
@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        var bloodhound = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '/search?q=%QUERY%',
                wildcard: '%QUERY%'
            },
        });
            
        $('#search').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'users',
            source: bloodhound,
            limit: 10,
            display: function(data) {
                return data.title_en
            },
            templates: {
                empty: [
                    `
                    <div class="list-group search-results-dropdown">
                        <div class="list-group-item">{{ __('Nothing found.') }}</div>
                    </div>
                    `
                ],
                header: [
                    `
                    <div class="list-group search-results-dropdown">
                    `
                ],
                suggestion: function(data) {
                    return `<div class="list-group-item uk-dropdown-navbar list-item-custom">
                        <ul class="uk-nav uk-nav-navbar">
                            <li>
                                <a class="list-group-item" href="details/` + data.id + `">
                                <b>{{ __('label.title_en') }}</b>` + ': ' + data.title_en + `<br>
                                <b>{{ __('label.title_vi') }}</b>` + ': ' + data.title_vn + `<br>
                                <b>{{ __('label.director') }}</b>` + ': ' + data.director + `
                                </a>
                            </li>
                        </ul>
                    </div>`
                }
            }
        });
    });
</script>
@endpush
