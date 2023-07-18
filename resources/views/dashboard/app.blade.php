@extends('layouts.dashboard')
@section('breadCrumb')
@parent
<li class="breadcrumb-item active"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$category_count}}</h3>

              <p>Categories</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('dashboard.categories.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$book_count}}</h3>

              <p>Books</p>
            </div>
            <div class="icon">
              <i class="fas fa-chart-pie"></i>
            </div>
            <a href="{{route('dashboard.books.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
    </div>
</div>
@endsection
