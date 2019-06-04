@extends('client.layouts.master')
@section('player')
<div class="single single-custom">
    <section class="trailer">
        <h3>{{ $epBySlug->film->title_vn }}</h3>
        <div class="trailer_frame">
            <iframe src="https://www.youtube.com/embed/{{ $epBySlug->url }}?autoplay=0&amp;controls=1&amp;showinfo=0&amp;rel=0&amp;loop=1&amp;modestbranding=1&amp;playlist={{ $epBySlug->url }}&amp;wmode=transparent" frameborder="0" allowfullscreen></iframe>
        </div>
    </section>
    <section class="links">
        <h3>{{ __('label.server') }}</h3>
        <ul class="wlinks">
            <h3>{{ __('label.youtube') }}</h3>
            @foreach ($epOfFilm as $episode)
            <li><a href="{{ route('episode', ['id' => $epBySlug->film->id, 'slug' => $episode->slug]) }}">{{ $episode->name }}</a></li>
            @endforeach
        </ul>
    </section>
</div>

@endsection

@section('content')

<div id="tm-right-section" class="uk-width-large-8-10 uk-width-medium-7-10" data-uk-scrollspy="{cls:'uk-animation-fade', target:'img'}">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p class="alert alert-danger message_error">{{ $error }}</p>
        @endforeach
    @endif
    <li>
        <div class="uk-margin-small-top divavatar">
            <h3 class="uk-text-contrast uk-margin-top">{{ __('label.comment') }}</h3>
            @if (!Auth::check())
            <div class="uk-alert uk-alert-warning" data-uk-alert="">
                <a href="" class="uk-alert-close uk-close"></a>
                <p>
                    <i class="uk-icon-exclamation-triangle uk-margin-small-right"></i> {{ __('label.please') }}
                    <a class="uk-text-contrast" href="{{ route('login') }}"> {{ __('label.login') }}</a> {{ __('label.or') }}
                    <a class="uk-text-contrast" href="{{ route('register') }}">{{ __('label.sign_up') }}</a> {{ __('label.to_post') }}
                </p>
            </div>
            @else
            <img class="uk-comment-avatar uk-border-circle avatarimg" src="{{ asset(config('setting.client_image.placeholder') . 'avatar4.svg') }}" alt="">
            @endif
            <form method="post" class="uk-form uk-margin-bottom" action="{{ route('comment') }}">
                @method('POST')
                @csrf
                <input type="hidden" value="{{ $film->id }}" name="film_id">
                <div class="uk-form-row">
                    <textarea class="uk-width-1-1 commenttext" cols="30" rows="5" placeholder="{{ __('label.type') }}" name="comment"></textarea>
                </div>
                <div class="uk-form-row">
                    <button type="submit" class="uk-button uk-button-large uk-button-success uk-float-right">{{ __('label.post') }}</button>
                </div>
            </form>
        </div>
        <div class="uk-scrollable-box-custom uk-responsive-width" data-simplebar-direction="vertical">
            <ul class="uk-comment-list uk-margin-top">
                @foreach ($comments as $comment)
                <li>
                    <article class="uk-comment uk-panel uk-panel-space uk-panel-box-secondary">
                        <header class="uk-comment-header">
                            <img class="uk-comment-avatar uk-border-circle" src="{{ asset(config('setting.client_image.placeholder') . 'avatar4.svg') }}" alt="">
                            <h4 class="uk-comment-title">{{ $comment->user->username }}</h4>
                            <div class="uk-comment-meta">{{ date('d-m-Y H:i:s', strtotime($comment->created_at)) }}</div>
                        </header>
                        <div class="uk-comment-body">
                            <p>{{ $comment->content }}</p>
                        </div>
                    </article>
                </li>
                @endforeach
            </ul>
        </div>
    </li>
</div>

@endsection
