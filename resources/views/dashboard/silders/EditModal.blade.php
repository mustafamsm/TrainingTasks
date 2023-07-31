


<div class="modal modal-edit-render  fade" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('site.edit') @lang('site.silder')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="#Edit-form" enctype="multipart/form-data">

                 <div id="edit-error-alert" class="alert alert-danger" style="display: none;"></div>

                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">@lang('site.title')</label>
                            <input type="text" class="form-control " value="{{old('title',$silder->title)}}" placeholder="{{__('site.title')}}" name="title"
                                id="title">

                        </div>
                        
                         
                        <div class="form-group">
                            <label for="start_date">@lang('site.start_date')</label>
                            <input type="date" class="form-control "  value="{{ $silder->start_date}}" name="start_date" id="start_date">

                        </div>
                        <div class="form-group">
                            <label for="end_date">@lang('site.end_date')</label>
                            <input type="date" class="form-control  " name="end_date"  value="{{old('end_date',$silder->end_date)}}" id="end_date">

                        </div>
                        <div class="form-group">
                            <label for="description">@lang('site.description')</label>
                            <textarea name="description" class="form-control">{{old('description',$silder->description)}}</textarea>

                        </div>
                        <div class="form-group">
                            <label for="status">{{__('site.status')}}</label>
                            <select name="status" id="status" class="form-control" >
                                <option value="1" @selected($silder->status == __('site.active'))>{{__('site.active')}}</option>
                                <option value="0" @selected($silder->status == __('site.inactive'))>{{__('site.inactive')}}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">@lang('site.image')</label>
                            <input type="file" class="form-control image " id="file" name="image"
                            accept="png,jpeg,jpg">
                            <img src="{{asset('storage/'.$silder->image)}}" class="img-thumbnail image-preview" alt="" width="120px"
                                    height="120px" id="image" name="image_preview"><br><br>
                        </div>
                    </div>
                    <input type="hidden" id="id" value="{{$silder->id}}">
            </div> 
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('site.close')</button>
                <button type="button" class="btn btn-primary btn-update"  >@lang('site.edit')</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
   
</div>
 
<script>
    $(".image").change(function() {
    
        if (this.files && this.files[0]) {
            var reader = new FileReader();
    
            reader.onload = function(e) {
                $('.image-preview').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(this.files[0]);
        }
    
    });
    
    </script>
    @php
    $curan =     $curan = LaravelLocalization::getCurrentLocale();;
    @endphp
      <script>
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $(document).on('click', '.btn-update', function(e) {

            e.preventDefault();
            var errorAlert = $('#edit-error-alert');
            var editBookForm = $('#Edit-form');
            id = $('#id').val();
            console.log(id);
            var form = $('#Edit-form')[0];
            var formData = new FormData(form);

            var fileInput = $('#file')[0];
            var file = fileInput.files[0];

            if (file) {
                formData.append('image', file);
            }

      

            var errorAlert = $('#edit-error-alert');
            $.ajax({
                type: 'POST',
                url: `/{{ $curan }}/dashboard/silder/ajaxupdate/${id}`,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    toastr.success(response.message);
                    $('#table_id').DataTable().draw(false);
                },
                error: function(xhr, textStatus, errorThrown) {
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        var errorMessages = '';
                        $.each(errors, function(field, messages) {
                            $.each(messages, function(index, message) {
                                errorMessages += '<li>' + message + '</li>';
                            });
                        });
                        errorAlert.html('<ul>' + errorMessages + '</ul>');
                        errorAlert.show();
                    } else {
                        alert('An error occurred');
                    }
                }

            });
            // axios.put(`/{{ $curan }}/dashboard/silders/${id}`, formData, {
            //         headers: {
            //             'Content-Type': 'multipart/form-data'
            //         }
            //     })
            //     .then(res => {
            //         toastr.success(res.data.message);
            //         $('#table_id').DataTable().draw(false);
            //         $('.modal-edit-render').modal('hide');
            //     }).catch(error => {
            //         var errors = error.response.data.errors;
            //         if (errors) {
            //             var errorMessages = '';
            //             $.each(errors, function(field, messages) {
            //                 $.each(messages, function(index, message) {
            //                     errorMessages += '<li>' + message + '</li>';
            //                 });
            //             });
            //             errorAlert.html('<ul>' + errorMessages + '</ul>');
            //             errorAlert.show();
            //         } else {
            //             toastr.error(error.response.data.message);
            //         }
            //     });
            // $.ajax({
            //     type: 'PUT',
            //      url:`/{{ $curan }}/dashboard/silders/${id}`,

            //     data: formData,
            //     processData: false,
            //     contentType: false,
            //     success: function(response) {
            //         toastr.success(response.message);
            //         $('#table_id').DataTable().draw(false);
            //     },
            //     error: function(xhr, textStatus, errorThrown) {
            //         var errors = xhr.responseJSON.errors;
            //         if (errors) {
            //             var errorMessages = '';
            //             $.each(errors, function(field, messages) {
            //                 $.each(messages, function(index, message) {
            //                     errorMessages += '<li>' + message + '</li>';
            //                 });
            //             });
            //             errorAlert.html('<ul>' + errorMessages + '</ul>');
            //             errorAlert.show();
            //         } else {
            //             alert('An error occurred');
            //         }
            //     }

            // });

        });
    </script>
