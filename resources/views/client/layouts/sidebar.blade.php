<div id="tm-left-section" class="uk-width-medium-3-10 uk-width-large-2-10 uk-hidden-small">
    <div class="uk-panel">
        <ul class="uk-nav uk-nav-comments uk-nav-side" data-uk-nav="">
            <li class="uk-nav-header uk-margin-small-bottom">{{ __('label.hot_single') }}</li>
            <div class="css-edit">
            <div class="uk1 uk-responsive-width" data-simplebar-direction="vertical">
                <ul class="uk-comment-list uk-margin-top">
                    @foreach ($singleFilmHot as $single)
                    <li>
                        <article class="uk-comment uk-panel uk-panel-space uk-panel-box-secondary">
                        <a href="#">
                            <div> 
                                <img src="{{ asset(config('setting.client_image.placeholder') . 'placeholder.png') }}" alt="Image" >
                            </div>
                        </a>
                        <p>{{ $single->title_en }}</p>
                        <div>
                            {{ __('label.view') }}: {{ $single->viewed_day }}
                        </div>
                        <div id="tm-right-section">
                            <span class="rating">
                                <i class="uk-icon-star"></i>
                                <i class="uk-icon-star"></i>
                                <i class="uk-icon-star"></i>
                                <i class="uk-icon-star"></i>
                                <i class="uk-icon-star"></i>
                            </span>
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
                        <a href="#">
                            <div> 
                                <img src="{{ asset(config('setting.client_image.placeholder') . 'placeholder.png') }}" alt="Image" >
                            </div>
                        </a>
                        <p>{{ $series->title_en }}</p>
                        <div>
                            {{ __('label.view') }}: {{ $series->viewed_day }}
                        </div>
                        <div id="tm-right-section">
                            <span class="rating">
                                <i class="uk-icon-star"></i>
                                <i class="uk-icon-star"></i>
                                <i class="uk-icon-star"></i>
                                <i class="uk-icon-star"></i>
                                <i class="uk-icon-star"></i>
                            </span>
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
