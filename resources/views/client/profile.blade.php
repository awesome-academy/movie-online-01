@extends('client.layouts.master')
@section('sidebar')
@stop

@section('profile')
<input type="hidden" value="{{ asset($defaultImg) }}" id="defaultImage">
<div id="tm-media-section" class="uk-block uk-block-small">
    <div class="uk-container uk-container-center uk-width-8-10">
        <div class="media-container  uk-container-center">
            <a class="uk-button uk-button-large uk-button-link uk-text-muted" href="{{ route('index') }}"><i class=" uk-icon-arrow-left uk-margin-small-right"></i> {{ __('Back') }}</a>
        </div>

        <div class="uk-grid">
            <div class="uk-width-medium-3-10">
                <div  class="media-cover">
                    <img id="preview" src="{{ asset($defaultImg) }}" class="thumb">
                </div>
                <form method="POST" id="upload_form" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="file" name="select_file" id="select_file" class="uk-button uk-button-primary uk-button-large uk-width-1-1 uk-margin-top" id="file" name="img" class="form-control-file border" onchange="encodeImageFileAsURL(this, 'preview')">
                    <input type="submit" name="upload" id="upload" value="Upload Avatar" class="uk-button uk-button-primary uk-button-large uk-width-1-1 uk-margin-top">
                </form>
                <div class="uk-text-success uk-margin-top" role="alert" id="message"></div>
            </div>
            <div class="uk-width-medium-7-10">
                <div class="">
                    <ul class="uk-tab uk-tab-grid " data-uk-switcher="{connect:'#media-tabs'}">
                        <li class="uk-width-medium-1-3 uk-active"><a href="#">{{ __('Profile') }}</a></li>
                        <li class="uk-width-medium-1-3"><a href="#">{{ __('Favourites Film') }}</a></li>
                        <li class="uk-width-medium-1-3"><a href="#">{{ __('Activity') }}</a></li>
                    </ul>
                </div>

                <ul id="media-tabs" class="uk-switcher">
                    <!--     start Tab Panel 1 (Reviews Sections) -->
                    <li>
                        <div class="uk-text-contrast uk-margin-large-top uk-grid uk-child-width-expand@s uk-text-center">
                            <div class="uk-width-1-6"><h4>{{ __('label.username') }}</h4></div>
                            <div class="uk-width-5-6">{{ $profile->username }}</div>
                        </div>
                        <hr>
                        <div class="uk-text-contrast uk-grid uk-child-width-expand@s uk-text-center">
                            <div class="uk-width-1-6"><h4>{{ __('label.full_name') }}</h4></div>
                            <div class="uk-width-5-6" id="full_name" data-old_value="{{ $profile->full_name }}" contenteditable="true" onblur="saveInlineEdit(this, 'full_name', {{ $profile->id }})">{{ $profile->full_name }}</div>
                        </div>
                        <hr>
                        <div class="uk-text-contrast uk-grid uk-child-width-expand@s uk-text-center">
                            <div class="uk-width-1-6"><h4>{{ __('label.email') }}</h4></div>
                            <div class="uk-width-5-6">{{ $profile->email }}</div>
                        </div>
                        <hr>
                        <div class="uk-text-contrast uk-grid uk-child-width-expand@s uk-text-center">
                            <div class="uk-width-1-6"><h4>{{ __('label.status') }}</h4></div>
                            <div class="uk-width-5-6">{{ __('Active') }}</div>
                        </div>
                        <hr>
                    </li>
                    <!--  ./ Tab Panel 1  -->
                    <!--  start Tab Panel 2  (Reviews Section) -->
                    <li>
                        <div class="uk-margin-small-top">  
                        </div>
                    </li>
                    <!--  ./ Tab Panel 2  -->
                    <!--     start Tab Panel 3 (Trailer Section)  -->
                    <li>
                        <div class="uk-cover uk-margin-top">
                        </div>
                    </li>
                   <!--     ./ Tab Panel 3  -->
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
@push('script')
    <script>
        $('#full_name').keypress(function(e){ 
            return e.which != 13; 
        });

        $(document).ready(function(){
            $('#upload_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url:'{{ route('profile.update', $profile->id) }}',
                    method:'POST',
                    data:new FormData(this),
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data) {
                        // console.log(data);
                        $('#message').css('display', 'block');
                        $('#message').html(data.message);
                        $('#message').addClass(data.class_name);
                        $('#uploaded_image').html(data.uploaded_image);
                    }
                })
            });
        });

        function saveInlineEdit(editableObj, column, id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if ($(editableObj).attr('data-old_value') === editableObj.innerHTML) {
                
                return false;
            }
            
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    full_name: $('#full_name').text(),
                    _method: 'PATCH',
                    _token: '{{ csrf_token() }}', 
                },
                url: '{{ route('profile.update', $profile->id) }}',
                success: function(data) {
                    // console.log(data);
                    $(editableObj).attr('data-old-value', editableObj.innerHTML);
                },
                error: function(data) {
                    console.log('error');
                }
            });
        }

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
