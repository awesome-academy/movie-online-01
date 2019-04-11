@extends('backend.layouts.master')

@section('content')

<div class="container col-md-8 col-md-offset-2">
    <div class="well well bs-component">
        <div class="content">
            <h2 class="header text-center">{{ trans('label.detail') }}</h2>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="well well bs-component">
        <p>{{ trans('label.menu_name') }}: {!! $menu->name !!}</p>
        <p>{{ trans('label.menu_slug') }}: {!! $menu->slug !!}</p>
        <br>
        @if (!$menu->parent_id)
        <b>{{ trans('label.child_me') }}: </b>
        <br>
        <br>
        <ul>
            @foreach ($dmenus as $dmenu)
                <li>{!! $dmenu->name !!}</li>
            @endforeach
        </ul>
        @else
            @foreach ($dmenus as $dmenu)
                <b>{{ trans('label.parent_me') }}: </b> {!! $dmenu->name !!}
            @endforeach
        @endif
    </div>
</div>
@endsection
