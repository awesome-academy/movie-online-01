 <!-- Sidebar -->
 <ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
           <i class="fas fa-fw fa-folder"></i>
           <span>{{ trans('label.home') }}</span>
       </a>
   </li>
   <li class="nav-item">
        <a class="nav-link" href="{{ route('user.index') }}">
           <i class="fas fa-fw fa-folder"></i>
           <span>{{ trans('label.user_ma') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.html">
           <i class="fas fa-fw fa-folder"></i>
           <span>{{ trans('label.role_ma') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('menu.index') }}">
           <i class="fas fa-fw fa-folder"></i>
           <span>{{ trans('label.menu_ma') }}</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>{{ trans('label.film_ma') }}</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{ route('film.index') }}">{{ trans('Film Manage') }}</a>
            <a class="dropdown-item" href="">{{ trans('label.episode_ma') }}</a>
            <a class="dropdown-item" href="">{{ trans('label.actor_film') }}</a>
            <a class="dropdown-item" href="">{{ trans('label.comment_ma') }}</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>{{ trans('label.actor_ma') }}</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>{{ trans('label.film_upload') }}</span></a>
        </li>
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>{{ trans('label.country_ma') }}</span></a>
        </li>
 </ul>
    <div id="content-wrapper">
        <div class="container-fluid">
         <!-- Breadcrumbs-->
