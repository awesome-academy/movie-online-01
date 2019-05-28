@extends('backend.layouts.master')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item active">{{ trans('label.country_ma') }}</li>
</ol>
</div>
<a class="btn btn-primary mybt" href="{{ route('country.create') }}">{{ trans('label.country_ma') }}</a>
<br>
<br>
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
@if (!$countries && !$country)
<p>{{ trans('message.nocountry') }}</p>
@else
<table class="table mytb" id="menus-table">
    <h3 class="text-center">{{ trans('label.country') }}</h3>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ trans('label.menu_name') }}</th>
            <th scope="col">{{ trans('label.menu_slug') }}</th>
            <th scope="col">{{ trans('label.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($countries as $country)
        <tr>
            <th scope="row">{{ $country->id }}</th>
            <td>{{ $country->name }}</td>
            <td>{{ $country->slug }}</td>
            <td>
                <a class="btn btn-success" href="{{ route('country.edit', ['id' => $country->id]) }}">{{ trans('label.edit') }}</a>
                <form method="POST" action="{{ route('country.destroy', ['id' => $country->id]) }}" class="pull-left tagForm">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">{{ trans('label.delete') }}</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
<!-- /.container-fluid -->
@stop

@push('scripts')
<script>
    $(document).ready(function() {
        $('.mytb').DataTable();
    });
</script>
@endpush
