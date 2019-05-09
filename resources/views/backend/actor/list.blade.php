@extends('backend.layouts.master')

@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">{{ __('label.dashboard') }}</a>
        </li>
        <li class="breadcrumb-item active">{{ __('label.actor_manage') }}</li>
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> {{ __('label.list_actor') }}
        </div>
        <a class="btn btn-primary" href="{{ route('actor.create') }}">{{ __('label.add_actor') }}</a>
        @if (session('msg'))
            <div class="alert alert-info" role="alert">
                {{ session('msg') }}
            </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                      <tr>
                        <th>{{ __('label.updated_at') }}</th>
                        <th>{{ __('label.real_name') }}</th>
                        <th>{{ __('label.stage_name') }}</th>
                        <th>{{ __('Slug') }}</th>
                        <th>{{ __('label.action') }}</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>{{ __('label.updated_at') }}</th>
                        <th>{{ __('label.real_name') }}</th>
                        <th>{{ __('label.stage_name') }}</th>
                        <th>{{ __('Slug') }}</th>
                        <th>{{ __('label.action') }}</th>  
                      </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($actors as $actor)
                            <tr>
                                <td data-order>{{ $actor->updated_at }}</td>
                                <td>{{ $actor->name_real }}</td>
                                <td>{{ $actor->name_vn }}</td>
                                <td>{{ $actor->slug }}</td>
                                <td>
                                    <a href="{{ route('actor.edit', ['id' => $actor->id]) }}">
                                        <button class="btn btn-primary btn-sm" ><i class="fas fa-edit"></i></button>
                                    </a>
                                    <form method="POST" action="{{ route('actor.destroy', ['id' => $actor->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
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
