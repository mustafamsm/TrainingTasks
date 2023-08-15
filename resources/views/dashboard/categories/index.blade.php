@extends('layouts.dashboard')
@section('breadCrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('dashboard.index') }}">{{ __('site.dashboard') }}</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.categories.index') }}">{{ __('site.categories') }}</a>
    </li>
@endsection
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif



    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ __('site.categories') }}
                        <div class="card-tools">

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                                {{ __('site.add') }}
                            </button>

                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table display responsive nowrap" style="width:100%" id="table_id">
                            <thead>
                                <tr>
                                    <th>{{ __('site.id') }}</th>
                                    <th>{{ __('site.name') }}</th>
                                    <th>{{ __('site.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- /Add modal -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('site.add') }}{{ __('site.category') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="form" enctype="multipart/form-data">
                        <div id="error-alert" class="alert alert-danger" style="display: none;"></div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name_ar">@lang('site.name_ar')</label>
                                <input type="text" class="form-control " placeholder="Name Of Category" name="name_ar"
                                    id="name_ar">

                            </div>
                            <div class="form-group">
                                <label for="name_en">@lang('site.name_en')</label>
                                <input type="text" class="form-control " placeholder="Name Of Category" name="name_en"
                                    id="name_en">

                            </div>
                            <div class="form-group">
                                <label for="">@lang('site.image')</label>
                                <input type="file" id="file" name="image"
                                   >


                            </div>
                           
                            <div class="form-group">
                                <label for="">@lang('site.status'):</label>
                                <select name="status" id="" class="form-control">
                                    <option value="">---------</option>
                                    <option value="1">@lang('site.active')</option>
                                    <option value="0">@lang('site.inactive')</option>
                                </select>
                            </div>


                        </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('site.close')</button>
                    <button type="button" class="btn btn-primary btn-submit">@lang('site.submit')</button>
                </div>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>
    <!-- /End Add modal -->

    <!-- /Edit modal -->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('site.edit') @lang('site.category')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="Edit-form" enctype="multipart/form-data">
                        <div id="edit-error-alert" class="alert alert-danger" style="display: none;"></div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" id="category_id">
                                <label for="name_ar">@lang('site.name_ar')</label>
                                <input type="text" class="form-control " placeholder="Name Of Category "
                                    name="name_ar" id="name_ar">
                            </div>
                            <div class="form-group">
                                <label for="name_en">@lang('site.name_en')</label>
                                <input type="text" class="form-control " placeholder="Name Of Category "
                                    name="name_en" id="name_en">
                            </div>
                            <div class="form-group">
                                <label for="image">@lang('site.image')</label>

                                <input type="file"  id="file" name="image"
                                    >
                                <img src="" class="img-thumbnail image-preview" alt="" width="120px"
                                    height="120px" id="image"><br><br>
                            </div>
                            <div class="form group">
                                <label for="">@lang('site.status') </label>
                                <select name="status" id="statusSelect" class="form-control">

                                    <option value="1">@lang('site.active')</option>
                                    <option value="0">@lang('site.inactive')</option>



                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('site.close')</button>
                    <button type="button" class="btn btn-primary btn-update">@lang('site.update')</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /End Edit modal -->
    <!-- /Show modal -->
    <div class="modal fade" id="modal-show">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('site.category')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <label>@lang('site.name_ar') </label>
                    <p id="show-name_ar"></p>
                    <label>@lang('site.name_en') </label>
                    <p id="show-name_en"></p>
                    <label>@lang('site.image') </label>
                    <img src="" class="responsive" alt="imge" id="show-image" width="120px"
                        height="120px"><br>
                    <label for="">@lang('site.status')</label>
                    <p id="show-status"></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /End Show modal -->
    <!-- /Show Books modal -->
    <div class="modal fade" id="modal-books">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('site.books') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table class="table table-bordered table-hover" id="book_table">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <!-- Add more table headers as needed -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table rows will be dynamically populated here -->
                        </tbody>
                    </table>



                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /End Show Books modal -->
    <script
        src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js
                                                                                                                                ">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @push('script')
        <script>
            @php
                $curan = LaravelLocalization::getCurrentLocale();
                
            @endphp
            $(function() {
                var table = $('#table_id').DataTable({
                    processing: true,
                    serverSide: true,

                    ajax: "{{ Route('dashboard.categories.getAll') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name_' + '{{ $curan }}',
                            name: 'name_' + '{{ $curan }}'
                        },


                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false

                        }
                    ]
                });

            });

            (function($) {
                ///Delete
                $(document).on('click', '.delete_btn', function(e) {
                    console.log("hhello from grade ")
                    e.preventDefault();
                    var id = $(this).attr('ajax_id');
                    console.log(id);
                    swal({
                            title: "{{ __('site.are_you_sure') }}",
                            text: "{{ __('site.once-deleted') }}",
                            icon: 'warning',
                            buttons: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        })
                        .then((value) => {
                            if (value) {
                                console.log('trrue');
                                $.ajax({
                                    type: 'DELETE',
                                    url: `/{{ $curan }}/dashboard/categories/${id}`,
                                    data: {
                                        '_token': '{{ csrf_token() }}',

                                    },
                                    beforeSend: function() {

                                        $('#loading-spinner').show();
                                    },
                                    success: function(res) {

                                        if (res.status === true) {
                                            $(`.Row${id}`).remove();
                                            swal({
                                                title: res.msg,
                                                icon: "success",
                                            })
                                        } else {
                                            console.error(res.msg);
                                            swal({
                                                title: res.msg,
                                                icon: "error",
                                            })

                                        }
                                    },
                                    error: function(res) {
                                        console.error(res);
                                    },
                                    complete: function() {
                                        $('#loading-spinner').hide();
                                    }
                                });
                            }
                        });

                });

                /// reset Add Error
                $(document).on('click', '.btn-default', function(e) {
                    var errorAlert = $('#error-alert');
                    errorAlert.hide();
                })
                /// reset Edit Error
                $(document).on('click', '.btn-default', function(e) {
                    var errorAlert = $('#edit-error-alert');
                    errorAlert.hide();
                })

                ///Add Ajax
                $(document).on('click', '.btn-submit', function(e) {

                    e.preventDefault();
                    var errorAlert = $('#error-alert');
                    var form = $('#form')[0];
                    var formData = new FormData(form);

                    //append the image to the form data to send it to the server using the uniq id from filepond
                    if (pond_id != 0) {
                        formData.append('image', pond_id);
                    }
                    
                    
                    $.ajax({
                        type: 'post',
                        url: `/{{ $curan }}/dashboard/categories/`,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            toastr.success(response.message);
                            $('#form').trigger('reset');
                            $('#table_id').DataTable().draw(false);
                            $('.image-preview').attr('src', '');
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

                });


                ///edit modal and fill input
                $('#modal-edit').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var name_ar = button.data('name_ar');
                    var name_en = button.data('name_en');
                    var category_id = button.data('id');
                    var image = button.data('image');
                    var status = button.data('status');
                    var image_url = `{{ asset('storage/category-images/${image}') }}`;
                    console.log('image', image_url);
                    var modal = $(this);
                    modal.find('#name_ar').val(name_ar);
                    modal.find('#name_en').val(name_en);
                    modal.find('#image').attr('src', image_url);
                    var statusSelect = $('#statusSelect');
                    statusSelect.val(status).trigger('change');
                    modal.find('#category_id').val(category_id);

                });

                //show modal
                $('#modal-show').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var name_ar = button.data('name_ar');
                    var name_en = button.data('name_en');
                    var status = button.data('status');
                    var status_name = '';
                    if (status == 1) {
                        status_name = '{{ __('site.active') }}';
                    } else {
                        status_name = '{{ __('site.inactive') }}';
                    }
                    var image = button.data('image');
                    var image_url = `{{ asset('storage/category-images/${image}') }}`;
                    var modal = $(this);
                    modal.find('#show-image').attr('src', image_url);
                    modal.find('#show-name_ar').html(name_ar);
                    modal.find('#show-name_en').html(name_en);
                    modal.find('#show-status').html(status_name);

                });
                //Update Ajax
                $(document).on('click', '.btn-update', function(e) {
                    e.preventDefault();
                    var errorAlert = $('#edit-error-alert');
                  
                    var id = $('#category_id').val();
                    var form = $('#Edit-form')[0];
                    var formData = new FormData(form);

                    if (pond_id != 0) {
                        formData.append('image', pond_id);
                    }

                    var errorAlert = $('#edit-error-alert');
                    $.ajax({
                        type: 'POST',

                        url: `/{{ $curan }}/dashboard/category/ajaxupdate/${id}`,

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

                });
                //show books
                var table = null;
                $('#modal-books').on('show.bs.modal', function(event) {

                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    console.log(id);
                    if (table !== null) {
                        table.destroy();
                    }
                    table = $('#book_table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "/dashboard/categories/" + id,
                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'name_'+'{{ $curan }}',
                                name: 'name_'+'{{ $curan }}'
                            },



                        ]
                    });

                });
                // $.ajax({
                //     type: 'GET',
                //     url: `/dashboard/categories/${id}`,
                //     success: function(data) {
                //         $('#table-body').empty();

                //         data.forEach(function(row) {
                //             var tableRow = '<tr>';
                //             tableRow += '<td>' + row.id + '</td>';
                //             tableRow += '<td>' + row.name + '</td>';
                //             // Add more columns as needed
                //             tableRow += '</tr>';

                //             $('#table-body').append(tableRow);
                //             $('#datatable').DataTable();
                //         });
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


                $(".image").change(function() {

                    if (this.files && this.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('.image-preview').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(this.files[0]);
                    }

                });
            })(jQuery);
        </script>
    @endpush
@endsection
