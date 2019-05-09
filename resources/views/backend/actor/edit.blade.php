@extends('backend.layouts.master')

@section('content')

<input type="hidden" value="{{ asset($defaultImg) }}" id="defaultImage">
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">{{ __('label.dashboard') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ __('Actor Management') }}</li>
</ol>

<div class="card card-register mx-auto mt-5">
    <div class="card-header">{{ __('Add New Actor') }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('actor.update', ['id' => $actor->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input type="text" id="real_name" value="{{ old('real_name', $actor->name_real) }}" class="form-control" name="real_name" placeholder="{{ __('label.real_name') }}" autofocus="autofocus">
                            <label for="real_name">{{ __('label.real_name') }}</label>
                        </div>
                        @if ($errors->first('real_name'))
                            <span class="text-danger">{{ $errors->first('real_name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input type="text" id="stage_name" class="form-control" value="{{ old('stage_name', $actor->name_vn) }}" name="stage_name" placeholder="{{ __('label.stage_name') }}">
                            <label for="stage_name">{{ __('label.stage_name') }}</label>
                        </div>
                        @if ($errors->first('stage_name'))
                            <span class="text-danger">{{ $errors->first('stage_name') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input type="date" id="birthday" value="{{ old('birthday', $actor->birthday) }}" class="form-control" name="birthday" placeholder="{{ __('label.birthday') }}">
                            <label for="birthday">{{ __('label.birthday') }}</label>
                        </div>
                        @if ($errors->first('birthday'))
                            <span class="text-danger">{{ $errors->first('birthday') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input type="text" id="location" value="{{ old('location', $actor->location) }}" class="form-control" name="location" placeholder="{{ __('label.location') }}">
                            <label for="location">{{ __('label.location') }}</label>
                        </div>
                        @if ($errors->first('location'))
                            <span class="text-danger">{{ $errors->first('location') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <img id="preview" src="{{ asset($defaultImg) }}" class="thumb">
                <label for="img">{{ __('label.image') }}<span class="text-danger">*</span></label>
                <input type="file" id="img" name="img" class="form-control-file border" onchange="encodeImageFileAsURL(this, 'preview')">
                @if ($errors->first('img'))
                    <span class="text-danger">{{ $errors->first('img') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary btn-block" href="">{{ __('label.update_actor') }}</button>
        </form>
        <div class="text-center">
        </div>
    </div>
</div>

@endsection
@push('scripts')

<script>
    function encodeImageFileAsURL(element, deploySelector) {
        var file = element.files[0];
        if (file == undefined) {
                $('#' + deploySelector).attr('src', $('#defaultImage').val());
                
                return false;
            }
        var reader = new FileReader();
        reader.onloadend = function() {
            // console.log('RESULT', reader.result)
            $('#preview').attr('src', reader.result);
        }
        reader.readAsDataURL(file);
    }
</script>

@endpush
