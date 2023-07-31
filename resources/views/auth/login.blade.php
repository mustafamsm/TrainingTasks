@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('login.perform') }}">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    
        
        <h1 class="h3 mb-3 fw-normal">{{__('site.login')}}</h1>

        @include('layouts.partials.messages')

        <div class="form-group form-floating mb-3">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{__('site.email')}}" required="required" autofocus>
            <label for="floatingName">{{__('site.email')}} </label>
        
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password"  placeholder="{{(__('site.password'))}}" required="required">
            <label for="floatingPassword">{{(__('site.password'))}}</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">{{__('site.login')}}</button>
        
      
    </form>
@endsection