@extends('backend.layouts.master')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item active">{{ trans('label.home') }}</li>
</ol>

<!-- Icon Cards-->
<div class="row row-custom">
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{ $totalUsers }} {{ __('label.user') }}!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">{{ __('label.view_details') }}</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5">{{ $totalViews }} {{ __('label.view') }}!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">{{ __('label.view_details') }}</span>
                <span class="float-right">
                <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">{{ $totalFilms }} {{ __('label.films') }}!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">{{ __('label.view_details') }}</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
</div>


<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-chart-area"></i>
        {{ __('label.view_chart') }}
    </div>
    <div class="card-body">
        <canvas id="myChart"></canvas>
    </div>
    
</div>
<!-- /.container-fluid -->
@endsection
@push('scripts')
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var data_views = {{ $views }};
var date = {!! $date !!};
var dynamicColors = function() {
    var r = Math.floor(Math.random() * 255);
    var g = Math.floor(Math.random() * 255);
    var b = Math.floor(Math.random() * 255);
    return 'rgb(' + r + ',' + g + ',' + b + ')';
}
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: date,
        datasets: [{
            label: '# {{ __('label.view_film') }}',
            fillColor: dynamicColors(),
            strokeColor: dynamicColors(),
            pointColor: dynamicColors(),
            pointStrokeColor: '#fff',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: data_views,
            backgroundColor: dynamicColors(),
            borderColor: dynamicColors(),
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
@endpush
