@extends('layouts.dashboard')

@php
    $curan = LaravelLocalization::getCurrentLocale();
@endphp

@section('breadCrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('dashboard.index') }}">@lang('site.dashboard')</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.settings.index') }}">@lang('site.settings')</a></li>
@endsection
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> @lang('site.settings') 
                        
                    </div>
                    <div class="card-body">
                     <div class="container">
                        <form action="{{route('dashboard.settings.store')}}" method="POST">
                            @csrf
                            {{-- <div class="form-group row">
                                <label for="inputName" class="col-sm-1-12 col-form-label"></label>
                                <div class="col-sm-1-12">
                                    <input type="text" class="form-control" name="inputName" id="inputName" placeholder="">
                                </div>
                            </div> --}}
                            <fieldset class="form-group row">
                                <legend class="col-form-legend col-sm-1-12">{{__('site.general_settings')}}</legend>

                              @foreach (config('settings') as $key=>$item)
                              <legend class="col-form-legend col-sm-1-12">{{__('site.'.$key)}}</legend>
                               
                                @foreach ($item as $k=>$i)
                                @if($k !=='site_favicon'  && $k !=='site_logo'   )
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="name_ar">{{__('site.'.$k)}}</label>
                                      <input type="text" name="{{$k}}" id="name_ar" class="form-control" placeholder="{{__('site.'.$k)}}" aria-describedby="helpId" value="{{old($k,$i)}}">
                                    </div>
                                </div>
                                @else
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="name_ar">{{__('site.'.$k)}}</label>
                                      <input type="file" name="{{$k}}" id="name_ar" class="form-control"  " aria-describedby="helpId"  >
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                
                              @endforeach
                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="name_ar">{{__('site.site_name_ar')}}</label>
                                      <input type="text" name="site_name_ar" id="name_ar" class="form-control" placeholder="{{__('site.site_name_ar')}}" aria-describedby="helpId" value="{{old('site_name_ar')}}">
                                       
                                    </div>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="name_en">{{__('site.site_name_en')}}</label>
                                      <input type="text" name="site_name_en" id="name_en" class="form-control" placeholder="{{__('site.site_name_en')}}" aria-describedby="helpId">
                                       
                                    </div>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="description_ar">{{__('site.site_description_ar')}}</label>
                                      <textarea   name="site_description_ar" id="description_ar" class="form-control" placeholder="{{__('site.site_description_ar')}}" aria-describedby="helpId"></textarea>

                                    </div>
                                    
                                </div>  
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="description_en">{{__('site.site_description_en')}}</label>
                                      <textarea   name="site_description_en" id="description_en" class="form-control" placeholder="{{__('site.site_description_en')}}" aria-describedby="helpId"></textarea>

                                    </div>
                                    
                                </div> 
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="message_ar">{{__('site.site_message_ar')}}</label>
                                      <textarea   name="site_message_ar" id="message_ar" class="form-control" placeholder="{{__('site.site_message_ar')}}" aria-describedby="helpId"></textarea>

                                    </div>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="message_en">{{__('site.site_message_ar')}}</label>
                                      <textarea   name="site_message_en" id="message_en" class="form-control" placeholder="{{__('site.site_message_en')}}" aria-describedby="helpId"></textarea>

                                    </div>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="site_footer_ar">{{__('site.site_footer_ar')}}</label>
                                      <textarea   name="site_footer_ar" id="footer_ar" class="form-control" placeholder="{{__('site.site_footer_ar')}}" aria-describedby="helpId"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="footer_en">{{__('site.site_footer_en')}}</label>
                                      <textarea   name="site_footer_en" id="footer_en" class="form-control" placeholder="{{__('site.site_footer_en')}}" aria-describedby="helpId"></textarea>
                                    </div>
                                </div>
                                 
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label for="">{{__('site.site_status')}}</label>
                                      
                                      <select name="site_status" id="" class="form-control">
                                            <option value="1">{{__('site.site_status_open')}}</option>
                                            <option value="0">{{__('site.site_status_close')}}</option>
                                      </select>
                                     </div>
                                </div> --}}
                            </fieldset>
                            {{-- <fieldset class="form-group row">
                                <legend class="col-form-legend col-sm-1-12">{{__('site.contact_info')}}</legend>
                                <div class="col-sm-1-12">
                                    
                                </div>
                            </fieldset> --}}
                  
                           
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Action</button>
                                </div>
                            </div>
                        </form>
                     </div>

                    </div>
                </div>
            </div>
        </div>
        <div id="model-box">

        </div>
    </div>








    @push('script')
      
    @endpush
@endsection
