@extends('client.layouts.master')
@section('content')

<div id="tm-right-section" class="uk-width-large-8-10 uk-width-medium-7-10" data-uk-scrollspy="{cls:'uk-animation-fade', target:'img'}">
    <h3><b>{{ __('label.new_single') }}</b></h3>
    <div class="margin uk-grid-width-small-1-3 uk-grid-width-medium-1-4 uk-grid-width-large-1-5" data-uk-grid="{gutter: 20}">
        @foreach ($singleFilm as $key)
            <div>
                <div class="uk-overlay uk-overlay-hover">
                    @if ($key->thumb)
                        <img src="{{ asset($key->thumb) }}" alt="Image" class="img_size overlay overlay-home">
                    @else
                        <img src="{{ asset(config('setting.client_image.placeholder') . 'placeholder.png') }}" alt="Image" class="img_size overlay overlay-home">
                    @endif
                    <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>
                    <a class="uk-position-cover" href="{{ route('show', ['id' => $key->id]) }}"></a>
                </div>
                <div class="uk-panel" >
                    <h5 class="uk-panel-title">{{ $key->title_en }}</h5>
                    <p>
                        <div class="rateit" data-rateit-value="{{ round(collect($key->votes)->avg('point'), 1) }}" data-rateit-readonly="true"></div>
                        <span class="uk-float-right">{{ $key->year }}</span>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="uk-margin-large-top uk-margin-bottom"></div>
    <h3><b>{{ __('label.new_series') }}</b></h3>
    <div class="margin uk-grid-width-small-1-3 uk-grid-width-medium-1-4 uk-grid-width-large-1-5" data-uk-grid="{gutter: 20}">
        @foreach ($seriesFilm as $key)
            <div>
                <div class="uk-overlay uk-overlay-hover">
                    @if ($key->thumb)
                        <img src="{{ asset($key->thumb) }}" alt="Image" class="img_size overlay overlay-home">
                    @else
                        <img src="{{ asset(config('setting.client_image.placeholder') . 'placeholder.png') }}" alt="Image" class="img_size overlay overlay-home">
                    @endif
                    <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>
                    <a class="uk-position-cover" href="{{ route('show', ['id' => $key->id]) }}"></a>
                </div>
                <div class="uk-panel" > 
                    <h5 class="uk-panel-title">{{ $key->title_en }}</h5>
                    <p>
                        <div class="rateit" data-rateit-value="{{ round(collect($key->votes)->avg('point'), 1) }}" data-rateit-readonly="true"></div>
                        <span class="uk-float-right">{{ $key->year }}</span>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
