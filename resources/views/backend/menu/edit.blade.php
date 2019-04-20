@extends('backend.layouts.master')

@section('content')

    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">
            <form class="form-horizontal" method="post">
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
                    <legend>{{ trans('label.add_menu') }}</legend>
                    <div class="form-group">
                        <label for="{{ trans('label.menu_name') }}"class="col-lg-2 control-label">{{ trans('label.menu_name') }}</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="title" value="{{ $menu->name }}" placeholder="{{ trans('label.menu') }}" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="{{ trans('label.category') }}" class="col-lg-2 control-label">{{ trans('label.category') }}</label>
                        <div class="col-lg-10">
                            <select class="form-control" id="category" name="valuemenu" multiple>
                                <option value="0" @if ($menu->parent_id == 0) selected = 'selected' @endif>
                                    {{ trans('label.pmenu') }}
                                </option>
                                @foreach ($parentmenus as $pmenu)
                                <option value="{!! $pmenu->id !!}" @if ($pmenu->id === $menu->parent_id) selected = 'selected' @endif>
                                    {!! $pmenu->name !!}
                                </option>
                                @endforeach
                            </select>
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
