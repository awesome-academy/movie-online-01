@extends('backend.layouts.master')

@section('content')
<div class="container">
    <h1>{{ trans('label.role_ma') }}</h1>
    <br>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewRole">{{ trans('label.add_role') }}</a>
    <br>
    <br>
    @if (session('msg'))
    <div class="uk-text-info msg">
        {{ session('msg') }}
    </div>
    @endif
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('label.rolename') }}</th>
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
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <p class="alert alert-danger message_error">{{ $error }}</p>
                @endforeach
                @endif
                <form id="roleForm" name="roleForm" class="form-horizontal">
                    <input type="hidden" name="role_id" id="role_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">{{ trans('label.rolename') }}</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="rolename" name="name" value="">
                        </div>
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
            ajax: "{{ route('role.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#createNewRole').click(function() {
            $('#saveBtn').val("create-role");
            $('#role_id').val('');
            $('#roleForm').trigger("reset");
            $('#modelHeading').html("");
            $('#ajaxModel').modal('show');
        });

        $('body').on('click', '.editRole', function() {
            var role_id = $(this).data('id');
            $.get("{{ route('role.index') }}" + '/' + role_id + '/edit', function(data) {
                $('#modelHeading').html("{{ trans('label.edit') }}");
                $('#saveBtn').val('');
                $('#ajaxModel').modal('show');
                $('#role_id').val(data.id);
                $('#rolename').val(data.name);
            })
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('');
            $.ajax({
                data: $('#roleForm').serialize(),
                url: "{{ route('role.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#roleForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                },
                error: function(data) {
                    console.log("{{ trans('label.error') }}", data);
                    $('#saveBtn').html("{{ trans('label.save') }}");
                }
            });
        });

        $('body').on('click', '.deleteRole', function() {
            var role_id = $(this).data("id");
            confirm("{{ trans('label.confirm') }}");

            $.ajax({
                type: "DELETE",
                url: "{{ route('role.store') }}" + '/' + role_id,
                success: function(data) {
                    table.draw();
                },
                 error: function(data) {
                    console.log('Error:', data);
                },
            });
        });
    })
</script>
@endpush
