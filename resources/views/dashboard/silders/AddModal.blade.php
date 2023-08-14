   <!-- /Add modal -->
   <div class="modal modal-add-render fade" tabindex="-1" role="dialog"   aria-hidden="true" >
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('site.add') @lang('site.silder')</h4>
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
                            <label for="name">@lang('site.title_ar')</label>
                            <input type="text" class="form-control " placeholder="{{__('site.title_ar')}}" name="title_ar"
                                id="title">

                        </div>
                        <div class="form-group">
                            <label for="name">@lang('site.title_en')</label>
                            <input type="text" class="form-control " placeholder="{{__('site.title_en')}}" name="title_en"
                                id="title">

                        </div>
                        
                         
                        <div class="form-group">
                            <label for="start_date">@lang('site.start_date')</label>
                            <input type="date" class="form-control  " name="start_date" id="start_date">

                        </div>
                        <div class="form-group">
                            <label for="end_date">@lang('site.end_date')</label>
                            <input type="date" class="form-control  " name="end_date" id="end_date">

                        </div>
                        <div class="form-group">
                            <label for="description">@lang('site.description_ar')</label>
                            <textarea name="description_ar" class="form-control"> </textarea>

                        </div>
                        <div class="form-group">
                            <label for="description">@lang('site.description_en')</label>
                            <textarea name="description_en" class="form-control"> </textarea>

                        </div>
                        <div class="form-group">
                            <label for="status">{{__('site.status')}}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">{{__('site.active')}}</option>
                                <option value="0">{{__('site.inactive')}}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">@lang('site.image')</label>
                            <input type="file" class="form-control image " id="file" name="image"
                            accept="png,jpeg,jpg">
                            <img src=" " class="img-thumbnail image-preview" alt="" width="120px"
                                    height="120px" id="image"><br><br>
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


 