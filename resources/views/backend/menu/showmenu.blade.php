@extends('backend.layouts.master')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item active">{{ trans('label.menu_ma') }}</li>
</ol>
</div>
<a class="btn btn-primary mybt" href="{{ route('addmenu') }}">{{ trans('label.add_menu') }}</a>
<br>
<br>
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
@if (!$menus && !$cmenus)
<p>{{ trans('message.nomenu') }}</p>
@else
<table class="table mytb">
    <h3 class="text-center">{{ trans('label.pmenu') }}</h3>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ trans('label.menu_name') }}</th>
            <th scope="col">{{ trans('label.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($menus as $menu)
            <tr>
                <th scope="row">{!! $menu->id !!}</th>
                <td>{!! $menu->name !!}</td>
                <td>
                    <a class="btn btn-success" href="{{ route('editmenu', ['id' => $menu->id]) }}">{{ trans('label.edit') }}</a>
                    <form method="post" action="{{ route('deletemenu', ['slug' => $menu->slug]) }}" class="pull-left tagForm">
                       @csrf
                        <div>
                            <button type="submit" class="btn btn-warning">{{ trans('label.delete') }}</button>
                        </div>
                    </form>
                    <a class="btn btn-info" href="{{ route('showdetail', ['slug' => $menu->slug]) }}">{{ trans('label.detail') }}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<br>
<table class="table mytb">
     <h3 class="text-center">{{ trans('label.child_me') }}</h3>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ trans('label.menu_name') }}</th>
            <th scope="col">{{ trans('label.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cmenus as $cmenu)
            <tr>
                <th scope="row">{!! $cmenu->id !!}</th>
                <td>{!! $cmenu->name !!}</td>
                <td>
                    <a class="btn btn-success" href="{{ route('editmenu', ['id' => $cmenu->id]) }}">{{ trans('label.edit') }}</a>
                    <form method="post" action="{{ route('deletemenu', ['slug' => $cmenu->slug]) }}" class="pull-left tagForm">
                        @csrf
                        <div>
                            <button type="submit" class="btn btn-warning">{{ trans('label.delete') }}</button>
                        </div>
                    </form>
                    <a class="btn btn-info" href="{{ route('showdetail', ['slug' => $cmenu->slug]) }}">{{ trans('label.detail') }}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
 @endif
<!-- /.container-fluid -->
@endsection
