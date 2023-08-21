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
    @if ($errors->any())
        <div class="alert alert-warning" role="alert">
            <ul class="list-unstyled mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
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
                            <form action="{{ route('dashboard.settings.store') }}" method="POST">
                                @csrf

                                <fieldset class="form-group row">

                                    @foreach (config('settings') as $key => $item)
                                        <legend class="col-form-legend col-sm-1-12">{{ __('site.' . $key) }}</legend>


                                        @foreach ($item as $k => $i)
                                            @if ($k !== 'site_favicon' && $k !== 'site_logo')
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="name_ar">{{ __('site.' . $k) }}</label>
                                                        <input type="text" name="{{ $k }}" id="name_ar"
                                                            class="form-control" placeholder="{{ __('site.' . $k) }}"
                                                            aria-describedby="helpId" value="{{ old($k, $i) }}">
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <h3>{{ __('site.' . $k) }}</h3>
                                                        <input type="file" name="{{ $k }}"
                                                            id="{{ $k }}">
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach

                                </fieldset>



                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Update</button>
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
        <script>
            // Get a reference to the file input element
            const inputElement1 = document.querySelector('input[name="site_logo"]');
            const inputElement2 = document.querySelector('input[name="site_favicon"]');
            // Register the plugin for validation type check
            FilePond.registerPlugin(FilePondPluginFileValidateType);

            //initialize filepond to create image
            FilePond.create(inputElement1, {
                labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,

                acceptedFileTypes: ['image/*'], //only image can be uploaded

            });
            FilePond.create(inputElement2, {
                labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,

                acceptedFileTypes: ['image/*'], //only image can be uploaded

            });
            FilePond.setOptions({
                server: {
                    url: '/upload',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
            });
        </script>
    @endpush
@endsection
