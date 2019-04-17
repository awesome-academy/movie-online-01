<div id="offcanvas" class="uk-offcanvas">
    <div class="uk-offcanvas-bar">
        <div class="uk-panel">
            <form class="uk-search">
                <input class="uk-search-field" type="search" placeholder="Search...">
            </form>
            <div class="uk-button-group">
                <a class="uk-button uk-button-link uk-button-large uk-text-muted" href="signup.html">{{ __('label.sign_up') }}</a>
                <a class="uk-button uk-button-success uk-button-large uk-margin-left" href="login.html"><i class="uk-icon-lock uk-margin-small-right"></i> {{ __('label.log_in') }}</a>
            </div>
        </div>
        <ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav>
            <li class="uk-active"><a href="#">{{ __('label.home') }}</a></li>
            <li><a href="#">{{ __('label.single') }}</a></li>
            <li><a href="#">{{ __('label.series') }}</a></li>
            <li><a href="#">{{ __('label.trailer') }}</a></li>
            <li class="uk-parent ">
                <a href="#">{{ __('label.genre') }}</a>
                <ul class="uk-nav-sub">
                    <li><a href="#">{{ __('label.action') }}</a></li>
                    <li><a href="#">{{ __('label.action') }}</a></li>
                    <li><a href="#">{{ __('label.action') }}</a></li>
                    <li><a href="#">{{ __('label.action') }}</a></li>
                    <li><a href="#">{{ __('label.action') }}</a></li>
                    <li><a href="#">{{ __('label.action') }}</a></li>
                    <li><a href="#">{{ __('label.action') }}</a></li>
                    <li><a href="#">{{ __('label.action') }}</a></li>
                </ul>
            </li>
            <li class="uk-nav-divider"></li>
            <li class="uk-nav-header">{{ __('label.page') }}</li>
            <li><a href=""> {{ __('label.home') }}</a></li>
            <li><a href=""> {{ __('label.terms') }}</a></li>
            <li><a href=""> {{ __('label.policy') }}</a></li>
            <li><a href=""> {{ __('label.contact') }}</a></li>
        </ul>
        <div class="uk-panel uk-text-center">
            <ul class="uk-subnav">
                <li><a href="#" class="uk-icon-hover uk-icon-medium uk-icon-facebook-square"></a></li>
                <li><a href="#" class="uk-icon-hover uk-icon-medium uk-icon-twitter"></a></li>
                <li><a href="#" class="uk-icon-hover uk-icon-medium uk-icon-instagram"></a></li>
                <li><a href="#" class="uk-icon-hover uk-icon-medium uk-icon-pinterest"></a></li>
            </ul>
        </div>
    </div>
</div>
