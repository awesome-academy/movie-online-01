<!DOCTYPE html>
<html lang="en-gb" dir="ltr" class="uk-height-1-1">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('label.title') }}</title>
        <!--     Include UIKit CSS   -->
        <link rel="stylesheet" href="{{ asset('bower_components/assets_template/assets/css/uikit.css') }}"> 
        <!--     Theme CSS   -->
        <link rel="stylesheet" href="{{ asset('bower_components/assets_template/assets/css/theme.css') }}">
    </head>
    <body  class="uk-height-1-1" cz-shortcut-listen="true">
        <!--     start Top Navbar   -->
        <div class="tm-navbar tm-navbar-overlay tm-navbar-transparent tm-navbar-contrast">
            <nav class="uk-navbar uk-margin-top">
                <div class="uk-container-center uk-container">
                    <ul class="uk-navbar-nav">
                        <li><a href="{{ route('index') }}"><i class="uk-icon-medium uk-icon-arrow-left"></i></a></li>
                    </ul>
                    <div class="uk-navbar-flip">
                        @yield('top_navbar')
                    </div>
                </div>
            </nav>
        </div>
        <!--     ./ Top Navbar   -->
        <!--     Start Main Content  -->
        @yield('main_content')
        <!-- ./ Main Content  -->
        <!--   Include JS  -->
        <script src="{{ asset('bower_components/assets_template/assets/js/jquery.js') }}"></script>
        <script src="{{ asset('bower_components/assets_template/assets/js/uikit.min.js') }}"></script>
        
    </body>
</html>
