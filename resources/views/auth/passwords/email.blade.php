@extends('layouts.app')

@section('top_navbar')
    <a class="uk-button uk-button-primary uk-button-large uk-float-left" href="{{ route('register') }}"><i class="uk-icon-lock uk-margin-small-right"></i>{{ __('label.sign_up') }}</a>
@endsection

@section('main_content')

    <div class="uk-overlay uk-text-center uk-vertical-align uk-height-1-1">
        <img class="uk-animation-fade tm-bg-cover" src="{{ asset(config('setting.client_image.placeholder') . 'bg.jpg') }}" alt="">
        <div class="uk-vertical-align  uk-overlay-panel uk-overlay-background">
            <div class=" uk-vertical-align-middle uk-text-center uk-width-medium-3-10 uk-width-large-2-10 uk-container-center">  
                <div class="uk-margin-large-bottom  uk-animation-reverse uk-animation-scale uk-animation-hover">
                    <img class="img-logo-custom uk-margin uk-margin-remove" alt="logo" src="{{ asset(config('setting.client_image.placeholder') . 'logo.svg') }}"/>
                </div>
                <h2 class="uk-margin-large-bottom uk-text-muted">{{ __('Reset Password') }}</h2>
                @if (session('status'))
                    <div class="uk-text-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form class=" uk-form" form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="uk-form-row">
                        <div class="uk-form-icon uk-form-icon-flip uk-width-1-1">
                            <input id="email" type="email" class="uk-width-1-1{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{ __('E-Mail Address') }}">
                            <i class="uk-icon-user"></i>
                        </div>
                        @if ($errors->has('email'))
                            <div class="uk-text-danger" role="alert">
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="uk-form-row">
                        <button type="submit" class="uk-width-1-1 uk-button uk-button-success uk-button-large">
                            {{ __('Send Password Reset') }}
                        </button>
                    </div>          
                </form>
            </div>
        </div>
    </div>

@endsection
