@extends('layouts.dashboard')
@section('breadCrumb')
@parent
<li class="breadcrumb-item "><a href="{{route('dashboard.index')}}">Dashboard</a></li>
<li class="breadcrumb-item active"><a href="{{route('dashboard.categories.index')}}">Categories</a></li>
@endsection
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif



    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Categories List Table
                        <div class="card-tools">
                            <a class="btn btn-success" href="{{ route('dashboard.books.create') }}">Create</a>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                                Add
                            </button>

                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="table_id">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>action</th>
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
                    <h4 class="modal-title">Add Category</h4>
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
                                <label for="name">Name</label>
                                <input type="text" class="form-control " placeholder="Name Of Category" name="name"
                                    id="name">

                            </div>
                            <div class="custom-file">

                                <input type="file" class="custom-file-input  " id="file" name="image"
                                    accept="png,jpeg,jpg">
                                <label class="custom-file-label" for="image">Choose Image</label>


                            </div>
                            <div class="form-group">
                                <label for="">Status:</label>
                                <select name="status" id="" class="form-control">
                                    <option value="">---------</option>
                                    <option value="1">Active</option>
                                    <option value="0">Not Active</option>
                                </select>
                            </div>


                        </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-submit">Submit</button>
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
                    <h4 class="modal-title">Edit Catgory</h4>
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
                                <label for="name">Name</label>
                                <input type="text" class="form-control " placeholder="Name Of Category" name="name"
                                    id="name">

                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input  " id="file" name="image"
                                    accept="png,jpeg,jpg">
                                <label class="custom-file-label" for="image">Choose Image</label>
                                <img src="" alt="" width="120px" height="120px" id="image"><br><br>
                            </div>
                            <div class="form group">
                                <label for="">Status </label>
                                <select name="status" id="statusSelect" class="form-control">

                                    <option value="1">Active</option>
                                    <option value="0">not Active</option>



                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-update">Update</button>
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
                    <h4 class="modal-title">Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <label>Name: </label>
                    <p id="show-name"></p>
                    <label>Image: </label>
                    <img src="" class="responsive" alt="imge" id="show-image" width="120px"
                        height="120px"><br>
                    <label for="">Status</label>
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
                    <h4 class="modal-title">Books</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table class="table table-bordered table-hover" id="datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <!-- Add more table headers as needed -->
                            </tr>
                        </thead>
                        <tbody id="table-body">
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js
                                                                                                "></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @push('script')
        <script>
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
                            data: 'name',
                            name: 'name'
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
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
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
                                    url: `/dashboard/categories/${id}`,
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

                    var fileInput = $('#file')[0];
                    var file = fileInput.files[0];
                    if (file) {
                        formData.append('image', file);
                    }
                    $.ajax({
                        type: 'post',
                        url: `{{ route('dashboard.categories.store') }}`,
                        data:formData ,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            toastr.success(response.message);
                            $('#form').trigger('reset');
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


                ///edit modal and fill input
                $('#modal-edit').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var name = button.data('name');
                    var category_id = button.data('id');
                    var image = button.data('image');
                    var status=button.data('status');
                    var image_url = `{{ asset('storage/category-images/${image}') }}`;
                    console.log('image', image_url);
                    var modal = $(this);
                    modal.find('#name').val(name);
                    modal.find('#image').attr('src', image_url);
                    var statusSelect = $('#statusSelect');
                   statusSelect.val(status).trigger('change');
                    modal.find('#category_id').val(category_id);

                });

                //show modal 
                $('#modal-show').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var name = button.data('name');
                    var status=button.data('status');
                    var status_name='';
                    if(status==1){
                        status_name='Active';
                    }else{
                        status_name="Not Active";
                    }
                    var image = button.data('image');
                    var image_url = `{{ asset('storage/category-images/${image}') }}`;
                    var modal = $(this);
                    modal.find('#show-image').attr('src', image_url);
                    modal.find('#show-name').html(name);
                    modal.find('#show-status').html(status_name);

                });
                //Update Ajax
                $(document).on('click', '.btn-update', function(e) {
                    e.preventDefault();
                    var editBookForm = $('#Edit-form');
                    var id = $('#category_id').val();
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

                        url: `/dashboard/category/ajaxupdate/${id}`,

                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            toastr.success(response.message);
                            $('#table_id').DataTable().draw(false);
                        },
                        error: function(xhr, textStatus, errorThrown) {

                        }

                    });

                });

                $('#modal-books').on('show.bs.modal', function(event) {

                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    console.log(id);
                    $.ajax({
                        type: 'GET',
                        url: `/dashboard/categories/${id}`,
                        success: function(data) {
                            $('#table-body').empty();

                            data.forEach(function(row) {
                                var tableRow = '<tr>';
                                tableRow += '<td>' + row.id + '</td>';
                                tableRow += '<td>' + row.name + '</td>';
                                // Add more columns as needed
                                tableRow += '</tr>';

                                $('#table-body').append(tableRow);
                                $('#datatable').DataTable();
                            });
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

            })(jQuery);
        </script>
    @endpush
@endsection
