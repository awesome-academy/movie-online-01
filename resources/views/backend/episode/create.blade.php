@extends('backend.layouts.master')

@section('content')

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">{{ __('label.dashboard') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ __('label.film_manage') }}</li>
</ol>

<div class="card card-register mx-auto mt-5">
    <div class="card-header">{{ __('label.add_film') }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('episode.store', ['id' => $film->id]) }}">
            @csrf
           
            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="name" class="form-control" value="{{ old('name') }}" name="name" placeholder="{{ __('Name') }}">
                    <label for="name">{{ __('Name') }}</label>
                </div>
                @if ($errors->first('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="url" class="form-control" value="{{ old('url') }}" name="url" placeholder="{{ __('URL') }}">
                    <label for="url">{{ __('URL') }}</label>
                </div>
                @if ($errors->first('url'))
                    <span class="text-danger">{{ $errors->first('url') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary btn-block" href="">{{ __('label.add_film') }}</button>
        </form>
        <div class="text-center">
        </div>
    </div>
</div>

@endsection
