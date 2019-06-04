<div id="tm-left-section" class="uk-width-medium-3-10 uk-width-large-2-10 uk-hidden-small">
    <div class="uk-panel">
    @if (Auth::check() && $favoriteFilms != null)
        <ul class="uk-nav uk-nav-comments uk-nav-side" data-uk-nav="">
            <li class="uk-nav-header uk-margin-small-bottom">{{ __('label.favorite_film') }}</li>
            <div class="css-edit">
                <div class="uk1 uk-responsive-width" data-simplebar-direction="vertical">
                    <ul class="uk-comment-list uk-margin-top">
                        @foreach ($favoriteFilms as $single)
                        <li>
                            <article class="uk-comment uk-panel uk-panel-space uk-panel-box-secondary">
                                <a href="{{ route('show', ['id' => $single['id']]) }}">
                                    @if ($single['thumb'])
                                    <img src="{{ asset($single['thumb']) }}" alt="Image" class="img_size overlay overlay-sidebar">
                                    @else
                                    <img src="{{ asset(config('setting.client_image.placeholder') . 'placeholder.png') }}" alt="Image" class="img_size overlay overlay-sidebar">
                                    @endif
                                </a>
                                <p class="uk-title-custom">{{ $single['title_en'] }}</p>
                                <div>
                                    {{ __('label.view') }}: {{ $single['views'] }}
                                </div>
                                <div id="tm-right-section">
                                    <div class="rateit" data-rateit-value="{{ round(collect($single['votes'])->avg('point'), 1) }}" data-rateit-readonly="true"></div>
                                </div>
                            </article>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <li class="uk-nav-divider"></li>
        </ul>
        @else
        <p class="uk-nav-header uk-margin-small-bottom">{{ __('label.favorite_film') }}</p>
        <p class="nofilm">{{ __('label.no_film') }}</p>
        @endif
        <ul class="uk-nav uk-nav-comments uk-nav-side" data-uk-nav="">
            <li class="uk-nav-header uk-margin-small-bottom">{{ __('label.hot_single') }}</li>
            <div class="css-edit">
                <div class="uk1 uk-responsive-width" data-simplebar-direction="vertical">
                    <ul class="uk-comment-list uk-margin-top">
                        @foreach ($singleFilmHot as $single)
                        <li>
                            <article class="uk-comment uk-panel uk-panel-space uk-panel-box-secondary">
                                <a href="{{ route('show', ['id' => $single['id']]) }}">
                                    @if ($single['thumb'])
                                    <img src="{{ asset($single['thumb']) }}" alt="Image" class="img_size overlay overlay-sidebar">
                                    @else
                                    <img src="{{ asset(config('setting.client_image.placeholder') . 'placeholder.png') }}" alt="Image" class="img_size overlay overlay-sidebar">
                                    @endif
                                </a>
                                <p class="uk-title-custom">{{ $single['title_en'] }}</p>
                                <div>
                                    {{ __('label.view') }}: {{ $single['views'] }}
                                </div>
                                <div id="tm-right-section">
                                    <div class="rateit" data-rateit-value="{{ round(collect($single['votes'])->avg('point'), 1) }}" data-rateit-readonly="true"></div>
                                </div>
                            </article>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <li class="uk-nav-divider"></li>
        </ul>
        <ul class="uk-nav uk-nav-comments uk-nav-side" data-uk-nav="">
            <li class="uk-nav-header uk-margin-small-bottom">{{ __('label.hot_series') }}</li>
            <div class="css-edit">
                <div class="uk1 uk-responsive-width" data-simplebar-direction="vertical">
                    <ul class="uk-comment-list uk-margin-top">
                        @foreach ($seriesFilmHot as $series)
                        <li>
                            <article class="uk-comment uk-panel uk-panel-space uk-panel-box-secondary">
                                <a href="{{ route('show', ['id' => $series['id']]) }}">
                                    @if ($series['thumb'])
                                    <img src="{{ asset($series['thumb']) }}" alt="Image" class="img_size overlay overlay-sidebar">
                                    @else
                                    <img src="{{ asset(config('setting.client_image.placeholder') . 'placeholder.png') }}" alt="Image" class="img_size overlay overlay-sidebar">
                                    @endif
                                </a>
                                <p class="uk-title-custom">{{ $series['title_en'] }}</p>
                                <div>
                                    {{ __('label.view') }}: {{ $series['views'] }}
                                </div>
                                <div id="tm-right-section">
                                    <div class="rateit" data-rateit-value="{{ round(collect($series['votes'])->avg('point'), 1) }}" data-rateit-readonly="true"></div>
                                </div>
                            </article>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <li class="uk-nav-divider"></li>
        </ul>
    </div>
</div>
