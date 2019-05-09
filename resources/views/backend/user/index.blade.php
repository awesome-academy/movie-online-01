@extends('backend.layouts.master')

@section('content')
<div class="container">
    <h1>{{ trans('label.user_ma') }}</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct">{{ trans('label.add_user') }}</a>
    <br>
    <br>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('label.username') }}</th>
                <th>{{ trans('label.email') }}</th>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
                <th>{{ trans('label.full_name') }}</th>
                <th>{{ trans('label.avatar') }}</th>
                <th>{{ trans('label.action') }}</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
@stop
@push('scripts')
<script type="text/javascript">
    $(function () {
        $.ajaxSetup ({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.index') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'full_name',
                    name: 'full_name'
                },
                {
                    data: 'avatar',
                    name: 'avatar',
                    render: function(data, type, row) {
                        return '<div class="div_img"><img class="img_avatar" src="/img/avatar_user/' + data + '"/></div>';
                    }   
                },
                {
                    data: 'action',
                    name: 'action',                                                             
                    orderable: false,
                    searchable: false
                },
            ]
        });
     });
</script>
@endpush
