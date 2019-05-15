@extends('client.layouts.master')
@section('sidebar')
@stop

@section('profile')
<div id="tm-media-section" class="uk-block uk-block-small">
    <div class="uk-container uk-container-center uk-width-8-10">
        <div class="media-container uk-container-center">
            <a class="uk-button uk-button-large uk-button-link uk-text-muted" href="{{ route('index') }}"><i class=" uk-icon-arrow-left uk-margin-small-right"></i> {{ __('Back') }}</a>
        </div>

        <div class="uk-grid">
            <div class="uk-width-medium-3-10">
                <div  class="media-cover">
                    <img id="preview" src="{{ asset($defaultImg) }}" class="thumb">
                </div>
            </div>
            <div class="uk-width-medium-7-10">
                <div class="">
                    <ul class="uk-tab uk-tab-grid " data-uk-switcher="{connect:'#media-tabs'}">
                        <li class="uk-width-medium-1-2 uk-active"><a href="#">{{ __('Profile') }}</a></li>
                        <li class="uk-width-medium-1-2"><a href="#">{{ __('Film') }}</a></li>
                    </ul>
                </div>

                <ul id="media-tabs" class="uk-switcher">
                    <!--     start Tab Panel 1 (Reviews Sections) -->
                    <li>
                        <div class="uk-text-contrast uk-margin-large-top uk-grid uk-child-width-expand@s uk-text-center">
                            <div class="uk-width-2-6"><h4>{{ __('Real Name') }}</h4></div>
                            <div class="uk-width-4-6">{{ $actor->name_vn }}</div>
                        </div>
                        <hr>
                        <div class="uk-text-contrast uk-grid uk-child-width-expand@s uk-text-center">
                            <div class="uk-width-2-6"><h4>{{ __('Stage Name') }}</h4></div>
                            <div class="uk-width-4-6">{{ $actor->name_real }}</div>
                        </div>
                        <hr>
                        <div class="uk-text-contrast uk-grid uk-child-width-expand@s uk-text-center">
                            <div class="uk-width-2-6"><h4>{{ __('Birthday') }}</h4></div>
                            <div class="uk-width-4-6">{{ $actor->birthday }}</div>
                        </div>
                        <hr>
                        <div class="uk-text-contrast uk-grid uk-child-width-expand@s uk-text-center">
                            <div class="uk-width-2-6"><h4>{{ __('Location') }}</h4></div>
                            <div class="uk-width-4-6">{{ $actor->location }}</div>
                        </div>
                        <hr>
                    </li>
                    <!--  ./ Tab Panel 1  -->
                    <!--  start Tab Panel 2  (Reviews Section) -->
                    <li>
                        <div  class="uk-scrollable-box uk-responsive-width" data-simplebar-direction="vertical">
                            @foreach ($data as $film)
                                <div class="film-actor">
                                    <div class="uk-overlay uk-overlay-hover uk-width-2-5">
                                        @if ($film->thumb)
                                            <img src="{{ asset($film->thumb) }}" alt="Image" class="img_size overlay overlay-actors">
                                        @else
                                            <img src="{{ asset(config('setting.client_image.placeholder') . 'placeholder.png') }}" alt="Image" class="overlay overlay-actors">
                                        @endif
                                        <div class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-overlay-icon"></div>
                                        <a class="uk-position-cover" href="{{ route('show', $film->id) }}"></a>
                                    </div>
                                    <div class="uk-panel uk-float-right uk-width-2-5">
                                        <h5 class="uk-panel-title text-color">{{ strtoupper($film->title_en) }}</h5>
                                        <h4>{{ $film->title_vn }}</h4>
                                        <p><b>{{ __('label.director') }}</b>: {{ $film->director }}</p>
                                        <p><b>{{ __('label.duration') }}</b>: {{ $film->duration }} {{ __('label.mins') }}</p>
                                        <p><b>{{ __('label.year') }}</b>: {{ $film->year }}</p>
                                        <p>
                                            <div class="rateit" data-rateit-value="{{ round($film->votes->avg('point'), 1) }}" data-rateit-readonly="true"></div>
                                        </p>
                                    </div>
                                    <hr>
                                </div>
                            @endforeach
                        </div>
                    </li>
                    <!--  ./ Tab Panel 2  -->
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
