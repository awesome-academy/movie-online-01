@extends('backend.layouts.master')

@section('content')

<input type="hidden" value="{{ asset($defaultImg) }}" id="defaultImage">
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">{{ __('label.dashboard') }}</a>
    </li>
    <li class="breadcrumb-item active">{{ __('label.film_manage') }}</li>
</ol>

<div class="card card-register mx-auto mt-5">
    <div class="card-header">{{ __('label.add_film') }}</div>
    <div class="card-body">
        <form method="POST" action="{{ route('film.update', ['id' => $film->id]) }}" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input type="text" id="titleEn" value="{{ old('title_en', $film->title_en) }}" class="form-control" name="title_en" placeholder="{{ __('label.title_en') }}" autofocus="autofocus">
                            <label for="titleEn">{{ __('label.title_en') }}</label>
                        </div>
                        @if ($errors->first('title_en'))
                            <span class="text-danger">{{ $errors->first('title_en') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input type="text" id="titleVn" class="form-control" value="{{ old('title_vn', $film->title_vn) }}" name="title_vn" placeholder="{{ __('label.title_vi') }}">
                            <label for="titleVn">{{ __('label.title_vi') }}</label>
                        </div>
                        @if ($errors->first('title_vn'))
                            <span class="text-danger">{{ $errors->first('title_vn') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input type="text" id="director" class="form-control" value="{{ old('director', $film->director) }}" name="director" placeholder="{{ __('label.director') }}">
                            <label for="director">{{ __('label.director') }}</label>
                        </div>
                        @if ($errors->first('director'))
                            <span class="text-danger">{{ $errors->first('director') }}</span>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="form-label-group">
                            <select name="country_id" id="" class="custom-select custom-select-lg">
                                @foreach ($countries as $country)
                                    <option 
                                        @if ($country->id === $film->country_id)
                                            selected
                                        @endif
                                        value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input type="text" id="year" value="{{ old('year', $film->year) }}" class="form-control" name="year" placeholder="{{ __('label.year') }}">
                            <label for="year">{{ __('label.year') }}</label>
                        </div>
                        @if ($errors->first('year'))
                            <span class="text-danger">{{ $errors->first('year') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input type="text" id="duration" value="{{ old('duration', $film->duration) }}" class="form-control" name="duration" placeholder="{{ __('label.duration') }}">
                            <label for="duration">{{ __('label.duration') }}</label>
                        </div>
                        @if ($errors->first('duration'))
                            <span class="text-danger">{{ $errors->first('duration') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input type="text" id="language" class="form-control" value="{{ old('language', $film->language) }}" name="language" placeholder="{{ __('label.language') }}">
                            <label for="language">{{ __('label.language') }}</label>
                        </div>
                        @if ($errors->first('language'))
                            <span class="text-danger">{{ $errors->first('language') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input type="text" id="quality" class="form-control" value="{{ old('quality', $film->quality) }}" name="quality" placeholder="{{ __('label.quality') }}">
                            <label for="quality">{{ __('label.quality') }}</label>
                        </div>
                        @if ($errors->first('quality'))
                            <span class="text-danger">{{ $errors->first('quality') }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-label-group">
                    <input type="text" id="trailer" class="form-control"
                    @if ($film->trailer)
                        value="{{ old('trailer', 'https://www.youtube.com/watch?v=' . $film->trailer) }}"
                    @endif
                    name="trailer" placeholder="{{ __('label.trailer_yt') }}">
                    <label for="trailer">{{ __('label.trailer_yt') }}</label>
                </div>
                @if ($errors->first('trailer'))
                    <span class="text-danger">{{ $errors->first('trailer') }}</span>
                @endif
            </div>
            <div class="form-group">
                <div class="form-label-group">
                    <select name="menu[]" id="" class="custom-select custom-select-lg" multiple>
                        <option value="" disabled selected>{{ __('label.genre') }}</option>
                        @foreach ($menus as $menu)
                            <option 
                            @foreach ($film->menus as $item)
                                @if ($menu->id === $item->id)
                                    selected
                                @endif
                            @endforeach
                            value="{{ $menu->id }}">{{ $menu->name }}</option>
                        @endforeach
                    </select> 
                </div>
                @if ($errors->first('menu'))
                    <span class="text-danger">{{ $errors->first('menu') }}</span>
                @endif
            </div>

            <div class="form-group">
                <div class="form-label-group">
                    <select name="actor[]" id="" class="custom-select custom-select-lg" multiple>
                        <option value="" disabled selected>{{ __('label.actor') }}</option>
                        @foreach ($actors as $actor)
                            <option 
                                @foreach ($film->actors as $item)
                                    @if ($actor->id === $item->id)
                                        selected 
                                    @endif
                                @endforeach
                            value="{{ $actor->id }}">{{ $actor->name_real }}</option>
                        @endforeach
                    </select> 
                </div>
                @if ($errors->first('actor'))
                    <span class="text-danger">{{ $errors->first('actor') }}</span>
                @endif
            </div>

            <div class="form-group">
                <div class="form-label-group">
                    <textarea class="form-control" name="description" id="description" placeholder="{{ __('label.description') }}" rows="5">{{ old('description', $film->description) }}</textarea>
                </div>
                @if ($errors->first('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
            </div>

            <div class="form-group">
                <img id="preview" src="{{ asset($defaultImg) }}" class="thumb">
                <label for="img">{{ __('label.image') }}<span class="text-danger">*</span></label>
                <input type="file" id="img" name="img" value="{{ old('thumb', $film->thumb) }}" class="form-control-file border" onchange="encodeImageFileAsURL(this, 'preview')">
                @if ($errors->first('img'))
                    <span class="text-danger">{{ $errors->first('img') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary btn-block" href="">{{ __('label.edit') }}</button>
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
