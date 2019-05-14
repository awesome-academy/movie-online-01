<!DOCTYPE html>
<html lang="en-gb" dir="ltr">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('label.title') }}</title>
        <!--     Include UIKit CSS   -->
        <link rel="stylesheet" href="{{ asset('bower_components/assets_template/assets/css/uikit.css') }}"> 
        <!--     Include Simplebar CSS   -->
        <link rel="stylesheet" href="{{ asset('bower_components/assets_template/assets/css/simplebar.css') }}">
        <!--     Theme CSS   -->
        <link rel="stylesheet" href="{{ asset('bower_components/assets_template/assets/css/theme.css') }}">
        <!--     swiper CSS   -->
        <link rel="stylesheet" href="{{ asset('bower_components/assets_template/assets/css/swiper.min.css') }}">
        <!--     style CSS   -->
        <link rel="stylesheet" href="{{ asset('bower_components/assets_template/assets/css/styles.css') }}">
        <!--    custom style CSS using laravelmix -->
        <link rel="stylesheet" href="{{ asset('custom-css/custom.css') }}">
        <!--    rateit css -->
        <link rel="stylesheet" href="{{ asset('jquery_rateit/rateit.css') }}">
        <!-- add -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>

        <!--     start Header Section   -->
        @include('client.layouts.topbar')

        @include('client.layouts.header')
        <!--     ./ Header Section   -->
        @yield('profile')
            <!--     start Main Section   -->
            <div class="uk-container uk-container-center uk-margin-large-top uk-margin-large-bottom">
                
                <div class="uk-grid">
                    @yield('player')
                    
                    @section('sidebar')
                        @include('client.layouts.sidebar')
                    @show

                    @yield('content')
                </div>
            </div>
            <!--     ./ Main Section   -->

        <!--     start Footer Section   -->

        @include('client.layouts.footer')

        <!--     start Offcanvas Menu   -->

        @include('client.layouts.offcanvas')

        <!--     ./ Offcanvas Menu   -->

        <!--     Include JS   -->
        
        
        <script src="{{ asset('bower_components/assets_template/assets/js/jquery.js') }}"></script>
        <script src="{{ asset('bower_components/assets_template/assets/js/uikit.min.js') }}"></script>
        <script src="{{ asset('bower_components/assets_template/assets/js/components/slideset.min.js') }}"></script>
        <script src="{{ asset('bower_components/assets_template/assets/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('bower_components/assets_template/assets/js/components/grid.min.js') }}"></script>
        <script src="{{ asset('typeahead/typeahead.bundle.min.js') }}"></script>
        <script src="{{ asset('jquery_rateit/jquery.rateit.js') }}"></script>
        <!-- App scripts -->
        @stack('script')
    </body>
</html>
