@extends('backend.layouts.master')

@section('content')
<div class="container">
    <h1>{{ trans('label.user_ma') }}</h1>
    <br>
    <br>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('label.username') }}</th>
                <th>{{ trans('label.email') }}</th>
                <th>{{ trans('label.full_name') }}</th>
                <th>{{ trans('label.role') }}</th>
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
                <form id="userForm" name="userForm" class="form-horizontal">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">{{ trans('label.username') }}</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="username" name="username" value="" readonly>
                        </div>
                    </div>
                    <div>
                        <label for="" class="col-sm-2 control-label">{{ __('label.role') }}</label>
                        <select name="role_id" id="role">
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="" class="col-sm-2 control-label">{{ __('label.state') }}</label>
                        <select id="banned" name="banned">
                            <option value="0">{{ __('label.banned') }}</option>
                            <option value="1">{{ __('label.nobanned') }}</option>
                        </select>
                    </div>
                    <br>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">{{ __('label.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@push('scripts')
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.index') }}",
            columns: [{
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
                    data: 'role.name',
                    name: 'role'
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
        $('body').on('click', '.editUser', function() {
            var user_id = $(this).data('id');
            $.get("{{ route('user.index') }}" + '/' + user_id + '/edit', function(data) {
                $('#modelHeading').html("{{ trans('label.edit') }}");
                $('#saveBtn').val('');
                $('#ajaxModel').modal('show');
                $('#user_id').val(data.id);
                $('#username').val(data.username);
                $('#role').val(data.role_id);
                $('#banned').val(data.banned);
            })
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');
            $.ajax({
                data: $('#userForm').serialize(),
                url: "{{ route('user.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#userForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                },
                error: function(data) {
                    console.log("{{ trans('label.error') }}", data);
                    $('#saveBtn').html("{{ trans('label.save') }}");
                }
            });
        });
    })
</script>
@endpush
