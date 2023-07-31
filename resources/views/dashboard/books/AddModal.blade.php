   <!-- /Add modal -->
   <div class="modal modal-add-render fade" tabindex="-1" role="dialog"   aria-hidden="true" >
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('site.add') @lang('site.book')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="form">
                    <div id="error-alert" class="alert alert-danger" style="display: none;"></div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">@lang('site.name')</label>
                            <input type="text" class="form-control " placeholder="{{__('site.name')}}" name="name"
                                id="name">

                        </div>
                        <div class="form-group">
                            <label for="author">@lang('site.author')</label>
                            <input type="text" class="form-control " placeholder="{{__('site.author')}}" name="author"
                                id="author">

                        </div>
                        <div class="form-group">
                            <label for="price">@lang('site.price')</label>
                            <input type="number" class="form-control " placeholder="{{__('site.price')}}" name="price"
                                id="price">

                        </div>
                        <div class="form-group">
                            <label for="publication">@lang('site.publication')</label>
                            <input type="date" class="form-control  " name="publication" id="author">

                        </div>
                        <div class="form-groub">
                            <label for="category_id">@lang('site.category')</label>
                            <select name="category_id" id="category_id"
                                class="form-control @error('category_id') is-invalid @enderror">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">@lang('site.description')</label>
                            <textarea name="description" class="form-control"> </textarea>

                        </div>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('site.close')</button>
                <button type="button" class="btn btn-primary btn-submit">@lang('site.create')</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /End Add modal -->


 
