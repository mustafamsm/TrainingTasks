    <!-- /Show modal -->
    <div class="modal show-modal-render fade"  >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('site.book')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <label>@lang('site.title_ar') </label>
                    <p >{{$silder->title_ar}}</p>
                   <label>@lang('site.title_en') </label>
                    <p >{{$silder->title_en}}</p>
                    <label>@lang('site.start_date') </label>
                    <p >{{$silder->start_date}}</p>
                    <label>@lang('site.end_date') </label>
                    <p >{{$silder->end_date}}</p>
                    <label>@lang('site.status') </label>
                    <p >{{$silder->status}}</p>
                    <label>@lang('site.image') </label>
                    <img src="{{asset('storage/silder-images/'.$silder->image)}}" width="100px" height="100px" alt="{{$silder->image}}"><br>
                    <label>@lang('site.description_ar') </label>
                    <p >{!! $silder->description_ar !!}</p>
                    <label>@lang('site.description_en') </label>
                    <p >{!! $silder->description_en !!}</p>

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
   
