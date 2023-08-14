@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$category_count}}</h3>

              <p>{{__('site.categories')}}</p>
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

              <p>{{__('site.books')}}</p>
            </div>
            <div class="icon">
              <i class="fas fa-chart-pie"></i>
            </div>
            <a href="{{route('dashboard.books.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
    </div>



</div>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    @foreach ($silders as $silder)
     <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
    @endforeach
  </ol>
  <div class="carousel-inner">
    @foreach ($silders as $silder)
    <div class="carousel-item {{ $loop->first ? ' active' : '' }}">
      <img class="d-block w-100   "   src="{{asset('storage/'.$silder->image)}}" alt="First slide"  width="300" height="300"  >

      <div class="carousel-caption d-none d-md-block">
        <h5>{{$silder->title}}</h5>
        <p>{{$silder->description ?? ''}}</p>
      </div>
    </div>
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

{{--
<div class="group-home-slideshow">
  <div class="home-slideshow-inner col-sm-12">
    <div class="home-slideshow">
      <div id="home_main-slider" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @foreach($silders as $photo)
                <li data-target="#home_main-slider" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
          @foreach($silders as $slider)
          <div class="item image {{ $loop->first ? ' active' : '' }}">
            <img src="{{asset('storage/'.$slider->image)}}" alt="slider" title="Image Slideshow">
            <div class="slideshow-caption position-right">
              <div class="slide-caption">
                <div class="group-caption">
                  <div class="content">
                    @if(!empty($slider->title))
                    <span class="title">
                      {{$slider->title}}
                    </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <a class="left carousel-control" href="#home_main-slider" data-slide="prev">
          <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#home_main-slider" data-slide="next">
          <span class="icon-next"></span>
        </a>
      </div>
    </div>
  </div>
</div> --}}
@endsection
