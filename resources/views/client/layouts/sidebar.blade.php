<div id="tm-left-section" class="uk-width-medium-3-10 uk-width-large-2-10 uk-hidden-small">
    <div class="uk-panel">
        <ul class="uk-nav  uk-nav-side uk-nav-parent-icon uk-margin-bottom" data-uk-nav="">
            <li class="uk-active"><a href="#">{{ __('label.home') }}</a></li>
            <li><a href="#">{{ __('label.single') }}</a></li>
            <li><a href="#">{{ __('label.series') }}</a></li>
            <li><a href="#">{{ __('label.trailer') }}</a></li>
            <li class="uk-parent ">
                <a href="#">{{ __('label.genre') }}</a>
                <ul class="uk-nav-sub">
                    <li><a href="#">{{ __('label.action') }}</a></li>
                    <li><a href="#">{{ __('label.action') }}</a></li>
                    <li><a href="#">{{ __('label.action') }}</a></li>
                    <li><a href="#">{{ __('label.action') }}</a></li>
                    <li><a href="#">{{ __('label.action') }}</a></li>
                    <li><a href="#">{{ __('label.action') }}</a></li>
                    <li><a href="#">{{ __('label.action') }}</a></li>
                    <li><a href="#">{{ __('label.action') }}</a></li>
                </ul>
            </li>
            <li class="uk-nav-divider"></li>
        </ul>
        <ul class="uk-nav uk-nav-comments uk-nav-side" data-uk-nav="">
            <li class="uk-nav-header uk-margin-small-bottom">{{ __('label.hot_single') }}</li>
            <div class="css-edit">
            <div class="uk1 uk-responsive-width" data-simplebar-direction="vertical">
                <ul class="uk-comment-list uk-margin-top">
                    @for ($i = 1; $i <= 5; $i++)
                    <li>
                        <article class="uk-comment uk-panel uk-panel-space uk-panel-box-secondary">
                        <a href="#">
                            <div> 
                                <img src="{{ asset(config('setting.client_image.placeholder') . 'placeholder.png') }}" alt="Image" >
                            </div>
                        </a>
                        <p>{{ __('label.name_film') }}</p>

                        <div>
                            {{ __('label.view') }}: 0
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
                    @endfor
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
                    @for ($i = 1; $i <= 5; $i++)
                    <li>
                        <article class="uk-comment uk-panel uk-panel-space uk-panel-box-secondary">
                        <a href="#">
                            <div> 
                                <img src="{{ asset(config('setting.client_image.placeholder') . 'placeholder.png') }}" alt="Image" >
                            </div>
                        </a>
                        <p>{{ __('label.name_film') }}</p>

                        <div>
                            {{ __('label.view') }}: 0
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
                    @endfor
                </ul>  
            </div>
            </div>
            <li class="uk-nav-divider"></li>
        </ul>
    </div>
</div>
