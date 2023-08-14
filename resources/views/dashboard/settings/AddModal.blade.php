   <!-- /Add modal -->
   <div class="modal modal-add-render fade" tabindex="-1" role="dialog"   aria-hidden="true" >
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('site.add') @lang('site.settings')</h4>
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
                            <label for="key">@lang('site.key')</label>
                            <input type="text" class="form-control " placeholder="{{__('site.key')}}" name="key"
                                id="key">
                        </div>
                        <div class="form-group">
                            <label for="value">@lang('site.value')</label>
                            <input type="text" class="form-control " placeholder="{{__('site.value')}}" name="value"
                                id="value">
                        </div>
                        <div class="from-group">
                            <select class="select">
                                @foreach ($groups as $group)
                                    <option value="{{$group->group}}">{{$group->group}}</option>
                                @endforeach
                            </select>
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


 