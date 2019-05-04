@extends('backend.layouts.master')

@section('content')

<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">{{ __('label.dashboard') }}</a>
        </li>
        <li class="breadcrumb-item active">{{ __('label.episode_management') }}</li>
    </ol>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i> {{ __('label.episode_of') . ' ' . $film->title_en }}
        </div>
        <a class="btn btn-primary" href="{{ route('episode.create', ['id' => $film->id]) }}">{{ __('label.add_episode') }}</a>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="dataTable" cellspacing="0">
                    <thead>
                      <tr>
                        <th>{{ __('label.updated_at') }}</th>
                        <th>{{ __('label.menu_name') }}</th>
                        <th>{{ __('Slug') }}</th>
                        <th>{{ __('Youtube ID') }}</th>
                        <th>{{ __('label.upload_by') }}</th>
                        <th>{{ __('label.action') }}</th> 
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>{{ __('label.updated_at') }}</th>
                        <th>{{ __('label.menu_name') }}</th>
                        <th>{{ __('Slug') }}</th>
                        <th>{{ __('Youtube ID') }}</th>
                        <th>{{ __('label.upload_by') }}</th>
                        <th>{{ __('label.action') }}</th>  
                      </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($film->episodes as $item)
                            <tr>
                                <td data-order>{{ $item->updated_at }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>{{ $item->url }}</td>
                                <td>{{ $item->user->full_name }}</td>
                                <td>
                                    <a href="{{ route('episode.edit', ['id' => $film->id, 'episode' => $item->id]) }}">
                                        <button class="btn btn-primary btn-sm" ><i class="fas fa-edit"></i></button>
                                    </a>

                                    <form method="POST" action="{{ route('episode.destroy', ['id' => $film->id, 'episode' => $item->id]) }}">
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
    </div>
</div>

@endsection
