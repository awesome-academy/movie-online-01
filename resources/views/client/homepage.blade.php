@extends('client.layouts.master')
@section('content')

<div id="tm-right-section" class="uk-width-large-8-10 uk-width-medium-7-10" data-uk-scrollspy="{cls:'uk-animation-fade', target:'img'}">
    <h3><b>{{ __('label.new_single') }}</b></h3>
    <div class="uk-grid-width-small-1-3 uk-grid-width-medium-1-4 uk-grid-width-large-1-5" data-uk-grid="{gutter: 20}">
        @for ($i = 1; $i <= 10; $i++)
            <div>
                <div class="uk-overlay uk-overlay-hover">
                    <img src="{{ asset(config('setting.client_image.placeholder') . 'placeholder.png') }}" alt="Image" >
                    <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background  uk-overlay-icon"></div>
                    <a class="uk-position-cover" href="media.html"></a>
                </div>
                <div class="uk-panel" >
                    
                    <h5 class="uk-panel-title">{{ __('label.name_film') }}</h5>
                    <p>
                        <span class="rating">
                            <i class="uk-icon-star"></i>
                            <i class="uk-icon-star"></i>
                            <i class="uk-icon-star"></i>
                            <i class="uk-icon-star"></i>
                            <i class="uk-icon-star"></i>
                        </span>
                        <span class="uk-float-right">2016</span>
                    </p>
                </div>
            </div>
        @endfor
    </div>
    <div class="uk-margin-large-top uk-margin-bottom">

    </div>

    <h3><b>{{ __('label.new_series') }}</b></h3>
    <div class="uk-grid-width-small-1-3 uk-grid-width-medium-1-4 uk-grid-width-large-1-5" data-uk-grid="{gutter: 20}">
        @for ($i = 1; $i <= 10; $i++)
            <div>
                <div class="uk-overlay uk-overlay-hover">
                    <img src="{{ asset(config('setting.client_image.placeholder') . 'placeholder.png') }}" alt="Image" >
                    <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background  uk-overlay-icon"></div>
                    <a class="uk-position-cover" href="media.html"></a>
                </div>
                <div class="uk-panel" >
                    
                    <h5 class="uk-panel-title">{{ __('label.name_film') }}</h5>
                    <p>
                        <span class="rating">
                            <i class="uk-icon-star"></i>
                            <i class="uk-icon-star"></i>
                            <i class="uk-icon-star"></i>
                            <i class="uk-icon-star"></i>
                            <i class="uk-icon-star"></i>
                        </span>
                        <span class="uk-float-right">2016</span>
                    </p>
                </div>
            </div>
        @endfor
    </div>
</div>

@endsection
