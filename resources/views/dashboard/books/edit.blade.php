@extends('layouts.dashboard')

@section('content')

<div class="row">

    <div class="col-md-6  ">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Update {{$book->name}}</h3>
            </div>
            <form action="{{route('dashboard.books.update',$book->id)}}" method="post" >
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" value="{{old('name',$book->name)}}" class="form-control @error('name') is-invalid @enderror" placeholder="Name Of Category" name="name" id="name">
                        @error('name')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" value="{{old('author',$book->author)}}" class="form-control @error('author') is-invalid @enderror" placeholder="Name Of Author" name="author" id="author">
                        @error('author')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" value="{{old('price',$book->price)}}" class="form-control @error('price') is-invalid @enderror" placeholder="price" name="price" id="price">
                        @error('price')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="publication">Publication</label>
                        <input type="date" value="{{old('publication',$book->publication)}}" class="form-control @error('publication') is-invalid @enderror"  name="publication" id="author">
                        @error('publication')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-groub">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @selected(old('category_id',$book->category_id)===$category->id)>{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description"  class="form-control @error('description') is-invalid @enderror" id="" cols="30" rows="10">{{old('description',$book->description)}}</textarea>
                        @error('description')
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