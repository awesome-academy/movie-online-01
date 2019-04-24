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
                <form class=" uk-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h2 class="uk-margin-large-bottom uk-text-muted">{{ __('label.login') }}</h2>
                    <div class="uk-form-row">
                        <div class="uk-form-icon uk-form-icon-flip uk-width-1-1">
                            <input id="username" type="text" class="uk-width-1-1{{ $errors->has('email') || $errors->has('username') ? 'is-invalid' : '' }}" name="username" value="{{ old('username') }}" required placeholder="{{ __('label.userOrEmail') }}">
                            <i class="uk-icon-user"></i>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                            @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <div class="uk-form-icon uk-form-icon-flip uk-width-1-1" >
                            <input type="password"  class="uk-width-1-1{{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('label.password') }}" name="password" required>
                            <i class="uk-icon-lock "></i>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="uk-form-row uk-text-small">
                        <label class="uk-float-left"><input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>{{ __('label.remember') }}</label>
                        @if (Route::has('password.request'))
                            <a class="uk-float-right uk-link" href="{{ route('password.request') }}">
                                {{ __('label.forgot_password') }}
                            </a>
                        @endif
                    </div>
                    <div class="uk-form-row">
                        <button type="submit" class="uk-width-1-1 uk-button uk-button-success uk-button-large">
                            {{ __('label.login') }}
                        </button>
                    </div>          
                </form>
            </div>
        </div>
    </div>

@endsection
