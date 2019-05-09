@extends('layouts.app')

@section('top_navbar')
    <a class="uk-button uk-button-success uk-button-large uk-float-left" href="{{ route('login') }}"><i class="uk-icon-lock uk-margin-small-right"></i>{{ __('label.login') }}</a>
@endsection

@section('main_content')

    <div class="uk-overlay uk-text-center uk-vertical-align uk-height-1-1">
        <img class="uk-animation-fade tm-bg-cover" src="{{ asset(config('setting.client_image.placeholder') . 'bg.jpg') }}" alt="">
        <div class="uk-vertical-align  uk-overlay-panel uk-overlay-background">
            <div class=" uk-vertical-align-middle uk-text-center  uk-width-medium-3-10 uk-width-large-2-10 uk-container-center">
                <div class="uk-margin-large-bottom  uk-animation-reverse uk-animation-scale uk-animation-hover">
                    <img class="img-logo-custom uk-margin uk-margin-remove" alt="logo" src="{{ asset(config('setting.client_image.placeholder') . 'logo.svg') }}"/>
                </div>
                <form  class="uk-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <h2 class="uk-margin-large-bottom uk-text-muted">{{ __('label.sign_up') }}</h2>
                    <div class="uk-form-row">
                        <div class="uk-form-icon uk-form-icon-flip uk-width-1-1">
                            <input type="text" class="uk-width-1-1{{ $errors->has('full_name') ? ' is-invalid' : '' }}" placeholder="{{ __('label.full_name') }}" name="full_name" value="{{ old('full_name') }}" required autofocus>
                            <i class="uk-icon-user"></i>
                        </div>
                        @if ($errors->has('full_name'))
                            <div class="uk-text-danger" role="alert">
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('full_name') }}</strong>
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="uk-form-row">
                        <div class="uk-form-icon uk-form-icon-flip uk-width-1-1">
                            <input type="text" class="uk-width-1-1{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="{{ __('label.username') }}" name="username" value="{{ old('username') }}" required autofocus>
                            <i class="uk-icon-user"></i>
                        </div>
                            @if ($errors->has('username'))
                                <div class="uk-text-danger" role="alert">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                </div>
                            @endif
                    </div>
                    <div class="uk-form-row">
                        <div class="uk-form-icon uk-form-icon-flip uk-width-1-1" >
                            <input type="text" class="uk-width-1-1{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" name="email" value="{{ old('email') }}" required autofocus>
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
                        <div class="uk-form-icon uk-form-icon-flip uk-width-1-1" >
                            <input type="password" class="uk-width-1-1{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('label.password') }}" name="password" value="{{ old('password') }}" required autofocus>
                            <i class="uk-icon-lock"></i>
                        </div>
                        @if ($errors->has('password'))
                            <div class="uk-text-danger" role="alert">
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            </div>
                        @endif
                    </div> 
                    <div class="uk-form-row">
                        <div class="uk-form-icon uk-form-icon-flip uk-width-1-1" >
                            <input type="password"  class="uk-width-1-1" name="password_confirmation" placeholder="{{ __('label.pass_confirm') }}">
                            <i class="uk-icon-lock "></i>
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <button type="submit" class="uk-width-1-1 uk-button uk-button-primary uk-button-large">
                            {{ __('label.sign_up') }}
                        </button>
                    </div>              
                </form>
            </div>
        </div>
    </div>

@endsection
