@extends('backend.layouts.master')

@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">{{ __('label.dashboard') }}</a>
        </li>
        <li class="breadcrumb-item active">{{ __('label.film_manage') }}</li>
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> {{ __('label.list_film') }}
        </div>
        <a class="btn btn-primary" href="{{ route('film.create') }}">{{ __('label.add_film') }}</a>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                      <tr>
                        <th>{{ __('label.title_en') }}</th>
                        <th>{{ __('label.title_vi') }}</th>
                        <th>{{ __('Slug') }}</th>
                        <th>{{ __('label.country') }}</th>
                        <th>{{ __('label.year') }}</th>
                        <th>{{ __('label.duration') }} ({{ __('label.mins') }})</th>
                        <th>{{ __('label.view') }}</th>
                        <th>{{ __('label.upload_by') }}</th>
                        <th>{{ __('label.created_at') }}</th>
                        <th>{{ __('label.action') }}</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>{{ __('label.title_en') }}</th>
                        <th>{{ __('label.title_vi') }}</th>
                        <th>{{ __('Slug') }}</th>
                        <th>{{ __('label.country') }}</th>
                        <th>{{ __('label.year') }}</th>
                        <th>{{ __('label.duration') }} ({{ __('label.mins') }})</th>
                        <th>{{ __('label.view') }}</th>
                        <th>{{ __('label.upload_by') }}</th>
                        <th>{{ __('label.created_at') }}</th>
                        <th>{{ __('label.action') }}</th>  
                      </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($films as $film)
                            <tr>
                                <td>{{ $film->title_en }}</td>
                                <td>{{ $film->title_vn }}</td>
                                <td>{{ $film->slug }}</td>
                                <td>{{ $film->country->name }}</td>
                                <td>{{ $film->year }}</td>
                                <td>{{ $film->duration }}</td>
                                <td>{{ $film->viewed_day }}</td>
                                <td>{{ $film->uploadByUser->username }}</td>
                                <td>{{ $film->created_at }}</td>
                                <td>
                                    <a href="{{ route('film.show', ['id' => $film->id]) }}">
                                        <button class="btn btn-primary btn-sm" >{{ __('label.edit') }}</button>
                                    </a>
                                    <form method="POST" action="{{ route('film.destroy', ['id' => $film->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">{{ __('label.delete') }}</button>
                                    </form>
                                </td>
                              </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">{{ __('label.updated') }} {{ date('d-m-Y', strtotime($updateLatest->updated_at)) }} {{ __('label.at') }} {{ date('H:i:s', strtotime($updateLatest->updated_at)) }}
        </div>
    </div>
</div>

@endsection
