@extends('layouts.dashboard')

@section('content')

<div class="row">

    <div class="col-md-6  ">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create New Categpry</h3>
            </div>
            <form action="{{route('dashboard.categories.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" placeholder="Name Of Category" name="name" id="name">
                        @error('name')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="custom-file">

                        <input type="file"  class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" accept="png,jpeg,jpg">
                        <label class="custom-file-label" for="image">Choose Image</label>
                        @error('image')
                        <span class="error invalid-feedback">{{ $message }}</span>

                        @enderror
                    </div>
                    <div class="form-groub">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="1" @selected(old('status') == 1)>Active</option>
                            <option value="0"  @selected(old('status') == 0)>Not Active</option>
                        </select>
                        @error('status')
                        <span class="error invalid-feedback">{{ $message }}</span>

                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection