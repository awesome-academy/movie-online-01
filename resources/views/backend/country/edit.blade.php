@extends('backend.layouts.master')

@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">
            <form class="form-horizontal" action="{{ route('country.update', ['id' => $country->id]) }}" method="POST">
                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @csrf
                <fieldset>
                    <legend>{{ trans('label.country_edit') }}</legend>
                    <div class="form-group">
                    <label for="{{ trans('label.menu_name') }}" class="col-lg-2 control-label">{{ trans('label.menu_name') }}</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="title" value="{{ $country->name }}" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary">{{ trans('label.save') }}</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
