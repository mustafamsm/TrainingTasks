@php
$curan = LaravelLocalization::getCurrentLocale();
@endphp
   <!-- /Show modal -->
    <div class="modal show-modal-render fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('site.book')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <label>@lang('site.name_ar') </label>
                    <p id="show-name">{{ $book->name_ar }}</p>
                    <label>@lang('site.name_en') </label>
                    <p id="show-name">{{ $book->name_en }}</p>
                    <label>@lang('site.author') </label>
                    <p id="show-author">{{ $book->author }}</p>
                    <label>@lang('site.price') </label>
                    <p id="show-price">{{ $book->price }}</p>
                    <label>@lang('site.publication') </label>
                    <p id="show-publication">{{ $book->publication }}</p>
                    <label>@lang('site.category') </label>
                    <p id="show-category_id">
                       {{$book->category->name}}
                    </p>
                    <label>@lang('site.description_ar') </label>
                    <p id="show-description">{!! $book->description_ar !!}</p>
                    <label>@lang('site.description_en') </label>
                    <p id="show-description">{!! $book->description_en !!}</p>
                    <label>@lang('site.image') </label>
                    <img src="{{ asset('storage/book-images/'.$book->image) }}" alt="" id="show-image" width="100px" height="100px">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('site.close')</button>

                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /End Show modal -->

    <script>
        $('.show-modal-render').on('hidden.bs.modal', function(e) {

            $('.show-modal-render').remove();
        });
    </script>
