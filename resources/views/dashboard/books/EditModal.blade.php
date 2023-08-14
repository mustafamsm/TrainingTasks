@php
$curan = LaravelLocalization::getCurrentLocale();
@endphp
<div class="modal modal-edit-render  fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('site.edit') @lang('site.book')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="Edit-form">
                    <div id="edit-error-alert" class="alert alert-danger" style="display: none;"></div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="book_id" value="{{ $book->id }}">
                    <div class="card-body">
                        <div class="form-group">

                            <label for="name_ar">@lang('site.name_ar')</label>
                            <input type="text" class="form-control " placeholder="{{ __('site.name_ar') }}"
                                name="name_ar" id="name" value="{{ $book->name_ar }}">

                        </div>
                        <div class="form-group">

                            <label for="name_en">@lang('site.name_en')</label>
                            <input type="text" class="form-control " placeholder="{{ __('site.name_en') }}"
                                name="name_en" id="name" value="{{ $book->name_en }}">

                        </div>
                        <div class="form-group">
                            <label for="author">@lang('site.author')</label>
                            <input type="text" class="form-control " placeholder="{{ __('site.author') }}"
                                name="author" id="author" value="{{ $book->author }}">

                        </div>
                        <div class="form-group">
                            <label for="price">@lang('site.price')</label>
                            <input type="number" class="form-control " placeholder="{{ __('site.price') }}"
                                name="price" id="price" value="{{ $book->price }}">

                        </div>
                        <div class="form-group">
                            <label for="publication">@lang('site.publication')</label>
                            <input type="date" class="form-control  " name="publication" id="publication"
                                value="{{ $book->publication }}">

                        </div>
                        <div class="form-groub">
                            <label for="category_id">@lang('site.category')</label>
                            <select name="category_id" id="category_id" class="form-control ">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($category->id == $book->category_id)>
                                      
                                    {{$category->name}}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="description">@lang('site.description_ar')</label>
                            <textarea name="description_ar" id="description" class="form-control">{{ $book->description_ar }} </textarea>

                        </div>
                        <div class="form-group">
                            <label for="description">@lang('site.description_en')</label>
                            <textarea name="description_en" id="description" class="form-control">{{ $book->description_en }} </textarea>

                        </div>
                       
                            <label for="image">@lang('site.image')</label>
                            <input type="file"  name="image" id="image" >
                    
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('site.close')</button>
                <button type="button" class="btn btn-primary btn-update">@lang('site.edit')</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

</div>

 
