@extends('client.layouts.master')
@section('content')

<div id="tm-media-section" class="uk-block-custom uk-block uk-block-small">
    @if (session('msg'))
    <div class="uk-text-info msg">
        {{ session('msg') }}
    </div>
    @endif
    <div class="uk-container-custom uk-container uk-container-center uk-width-8-10">
        <div class="uk-grid">
            <div class="uk-width-medium-3-10">
                <div  class="media-cover-custom media-cover">
                    <img src="{{ asset($details->thumb) }}" alt="Image" class="uk-scrollspy-inview uk-animation-fade">
                </div>
                @if ($slug)
                    <a class="uk-button uk-button-primary uk-button-large uk-width-1-1 uk-margin-top" href="{{ route('episode', ['id' => $details->id, 'slug' => $slug]) }}">
                        <i class="uk-icon-television uk-margin-small-right"></i> {{ __('label.watch') }}
                    </a>
                @else
                    <a class="uk-button uk-button-primary uk-button-large uk-width-1-1 uk-margin-top" href="#">
                        <i class="uk-icon-television uk-margin-small-right"></i> {{ __('label.watch') }}
                    </a>
                @endif

                @if (Auth::check())
                    @if (!$favorite)
                        <a class="uk-button uk-button-link uk-text-muted uk-button-large uk-width-1-1 uk-margin-top btn_save_film" href="{{ route('savefavoritefilm', ['id' => $details->id]) }}"><i class="uk-icon-heart uk-margin-small-right"></i> {{ __('label.favourite') }}</a>
                    @else
                        <a id="removefilm" class="uk-button uk-button-link uk-text-muted uk-button-large uk-width-1-1 uk-margin-top btn_save_film" href="{{ route('removefavoritefilm', ['id' => $details->id]) }}"><i class="uk-icon-close uk-margin-small-right"></i> {{ __('label.remove_favourite') }}</a>
                    @endif
                @else
                    <button class="uk-button uk-button-link uk-text-muted uk-button-large uk-width-1-1 uk-margin-top btn_save_film" onclick="authenticate()"><i class="uk-icon-heart uk-margin-small-right"></i> {{ __('label.favourite') }}</button>
                    <p id="authentication">
                        <i class="uk-icon-exclamation-triangle uk-margin-small-right"></i> {{ __('label.please') }}
                        <a class="uk-text-contrast" href="{{ route('login') }}"> {{ __('label.login') }}</a> {{ __('label.or') }}
                        <a class="uk-text-contrast" href="{{ route('register') }}">{{ __('label.sign_up') }}</a> {{ __('label.to_save_film') }}
                    </p>
                @endif
                </div>
            <div class="uk-width-medium-7-10">
                <div class="">
                    <ul class="uk-tab uk-tab-grid " data-uk-switcher="{connect:'#media-tabs'}">
                        <li class="uk-width-medium-1-3 uk-active"><a href="#">{{ __('label.desc') }}</a></li>
                        <li class="uk-width-medium-1-3"><a href="#">{{ __('label.review') }}</a></li>
                        <li class="uk-width-medium-1-3"><a href="#">{{ __('label.trailer') }}</a></li>     
                    </ul>
                </div>
                    <ul id="media-tabs" class="uk-switcher">
                         <!--     start Tab Panel 1 (Reviews Sections) -->
                        <li>
                            <h2 class="uk-text-contrast uk-margin-large-top">{{ $details->title_en }}
                                <div id="rateit_star1" data-productid="{{ $details->id }}" class="rateit" data-rateit-value="{{ Auth::check() ? $voteOfUser->point : $votes }}"></div>
                            </h2>
                            <ul class="uk-subnav uk-subnav-line">
                                <li>
                                    <i class="uk-icon-star uk-margin-small-right"></i>
                                    <div class="vote">
                                        @if ($votes == 0)
                                            0
                                        @else
                                            {{ $votes }}
                                        @endif
                                    </div>
                                </li>
                                <li><i class="uk-icon-clock-o uk-margin-small-right"></i> {{ $details->duration }} {{ __('label.mins') }}</li>
                                <li>{{ $details->year }}</li>
                            </ul>
                            <hr>
                            <p class="uk-text-muted uk-h4">{{ $details->description }}</p>
                            <dl class="uk-description-list-horizontal uk-margin-top">
                                <dt>{{ __('label.starring') }}</dt>
                                <dd>
                                    <ul class="uk-subnav">
                                        @foreach ($actors as $actor)
                                            <li><a href="#">{{ $actor->name_real }}</a></li>
                                        @endforeach
                                        <li><a href="#"></a></li>
                                    </ul>
                                </dd>
                                <dt>{{ __('label.genre') }}</dt>
                                <dd>
                                    <ul class="uk-subnav">
                                    @foreach ($genres as $genre)
                                        <li><a href="#">{{ $genre->name }}</a></li>
                                    @endforeach
                                    <li><a href="#"></a></li>
                                    </ul>
                                </dd>
                                <dt>{{ __('label.country') }}</dt>
                                <dd>
                                    <ul class="uk-subnav">
                                    @foreach ($countries as $country)
                                        <li><a href="#">{{ $country->name }}</a></li>
                                    @endforeach
                                    </ul>
                                </dd>
                            </dl>
                        </li>
                        <!--    ./ Tab Panel 1  -->
                        <!--     start Tab Panel 2  (Reviews Section) -->
                        <li>
                            <div class="uk-margin-small-top">
                                <h3 class="uk-text-contrast uk-margin-top">{{ __('label.post_review') }}</h3>
                                <div class="uk-alert uk-alert-warning" data-uk-alert="">
                                    <a href="" class="uk-alert-close uk-close"></a>
                                    <p>
                                        <i class="uk-icon-exclamation-triangle uk-margin-small-right"></i> {{ __('label.please') }}
                                        <a class="uk-text-contrast" href="#"> {{ __('label.login') }}</a> {{ __('label.or') }}
                                        <a class="uk-text-contrast" href="#">{{ __('label.sign_up') }}</a> {{ __('label.to_post') }}
                                    </p>
                                </div>
                                <form class="uk-form uk-margin-bottom">
                                    <div class="uk-form-row">
                                        <textarea class="uk-width-1-1" cols="30" rows="5" placeholder="{{ __('label.type') }}"></textarea>   
                                    </div>
                                    <div class="uk-form-row">
                                        <a href="" class="uk-button uk-button-large uk-button-success uk-float-right">{{ __('label.post') }}</a>
                                    </div>
                                </form>
                            </div>
                            <div  class="uk-scrollable-box uk-responsive-width" data-simplebar-direction="vertical">
                                <ul class="uk-comment-list uk-margin-top" >
                                    @foreach ($comments as $comment)
                                    <li>
                                        <article class="uk-comment uk-panel uk-panel-space uk-panel-box-secondary">
                                            <header class="uk-comment-header">
                                                <img class="uk-comment-avatar uk-border-circle" src="{{ asset(config('setting.client_image.placeholder') . 'avatar4.svg') }}" alt="">
                                                <h4 class="uk-comment-title">{{ $comment->user->username }}</h4>
                                                <div class="uk-comment-meta">{{ date('d-m-Y H:i:s', strtotime($comment->created_at)) }}</div>
                                            </header>
                                            <div class="uk-comment-body">
                                                <p>{{ $comment->content }}</p>
                                            </div>
                                        </article>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                       <!--     ./ Tab Panel 2  -->
                       <!--     start Tab Panel 3 (Trailer Section)  -->
                        <li>
                            <div class="uk-cover-custom uk-cover uk-margin-top">
                                <iframe class = "data-uk-cover-custom data-uk-cover" src="https://www.youtube.com/embed/{{ $details->trailer }}?autoplay=0&amp;controls=1&amp;showinfo=1&amp;rel=0&amp;loop=1&amp;modestbranding=1&amp;wmode=transparent" frameborder="0" allowfullscreen=""></iframe>
                            </div>
                        </li>
                       <!--     ./ Tab Panel 3  -->
                    </ul>
                </div>
            </div>  
        <div class="uk-block ">
            <div class="uk-container-center uk-container uk-margin-large-bottom">
                <h3 class="uk-margin-large-bottom uk-text-contrast">{{ __('label.also_like') }}</h3>
                <div class="uk-margin" data-uk-slideset="{small: 2, medium: 4, large: 6}">
                    <div class="uk-slidenav-position uk-margin">
                        <ul class="uk-slideset uk-grid uk-flex-center">
                            @foreach ($filmOfMenu as $key)
                                @foreach ($key as $element)
                                        <li>
                                            <a href="{{ route('show', ['id' => $element->id ]) }}"><img src="{{ asset(config('setting.client_image.placeholder') . 'placeholder.png') }}" alt="">
                                            </a>
                                        </li>
                                @endforeach
                            @endforeach
                        </ul>
                        <a href="#" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideset-item="previous"></a>
                        <a href="#" class="uk-slidenav uk-slidenav-next uk-slidenav-contrast" data-uk-slideset-item="next"></a>
                    </div>
                    <ul class="uk-slideset-nav uk-dotnav uk-dotnav-contrast uk-flex-center uk-margin-top"></ul>
                </div>
            </div>
        </div>
    </div>
</div>

@stop 
@push('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function authenticate() {
        document.getElementById("authentication").classList.add('authentication');
    }

    $(function () {
       $('#rateit_star1').bind('rated', function (e) {
        @if (!Auth::check())
            alert('{{ __('Please Login to vote') }}');
        @endif
        var ri = $(this);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                _token: '{{ csrf_token() }}', 
                point: ri.rateit('value'),
                film_id: ri.data('productid'),
                user_id: '{{ Auth::id() }}',
            },
            url: '{{ route('vote') }}',
            success: function(data) {
                $.get("{{ route('show', $details->id) }}", function (data) {
                    $('.vote').html(data);
                })
            },
            error: function(data) {
                console.log('error');
            }
         })
     });
   });
</script>
@endpush
