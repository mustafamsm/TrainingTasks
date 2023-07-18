@extends('layouts.dashboard')
@section('breadCrumb')
@parent
<li class="breadcrumb-item "><a href="{{route('dashboard.index')}}">@lang('site.dashboard')</a></li>
<li class="breadcrumb-item "><a href="{{route('dashboard.books.index')}}">@lang('site.books')</a></li>
<li class="breadcrumb-item active"><a href="{{route('dashboard.books.trached')}}">@lang('site.trash')</a></li>
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
                        <i class="fa fa-align-justify"></i> @lang('site.books') Trached List Table
                        <div class="card-tools">
                            <button type="button" class="btn btn-warning restore_all">
                                <i class="fas fa-redo"></i>@lang('site.restore-all')
                            </button>

                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="table_id">
                            <thead>
                                <tr>
                                    <th>@lang('site.id')</th>
                                    <th>@lang('site.name')</th>
                                    <th>@lang('site.price')</th>
                                    <th>@lang('site.action')</th>
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
                    <h4 class="modal-title"> Book</h4>
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
                                <label for="name">Name</label>
                                <input type="text" class="form-control " placeholder="Name Of Category" name="name"
                                    id="name">

                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" class="form-control " placeholder="Name Of Author" name="author"
                                    id="author">

                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control " placeholder="price" name="price"
                                    id="price">

                            </div>
                            <div class="form-group">
                                <label for="publication">Publication</label>
                                <input type="date" class="form-control  " name="publication" id="author">

                            </div>
                            <div class="form-groub">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control  " id="" cols="30" rows="10"> </textarea>

                            </div>
                        </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-submit">Submit</button>
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
                    <h4 class="modal-title">Edit Book</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="Edit-form">
                        <div id="edit-error-alert" class="alert alert-danger" style="display: none;"></div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" id="book_id">
                                <label for="name">Name</label>
                                <input type="text" class="form-control " placeholder="Name Of Category"
                                    name="name" id="name">

                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" class="form-control " placeholder="Name Of Author" name="author"
                                    id="author">

                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control " placeholder="price" name="price"
                                    id="price">

                            </div>
                            <div class="form-group">
                                <label for="publication">Publication</label>
                                <input type="date" class="form-control  " name="publication" id="publication">

                            </div>
                            <div class="form-groub">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control  ">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control  " cols="30" rows="10"> </textarea>

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
                    <h4 class="modal-title">@lang('site.book')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <label>@lang('site.name') </label>
                    <p id="show-name"></p>
                    <label>@lang('site.author'): </label>
                    <p id="show-author"></p>
                    <label>@lang('site.price'): </label>
                    <p id="show-price"></p>
                    <label>@lang('site.publication'): </label>
                    <p id="show-publication"></p>
                    <label>@lang('site.publication'): </label>
                    <p id="show-category_id"></p>
                    <label>@lang('site.description'): </label>
                    <p id="show-description"></p>


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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js
                                                                        "></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"
        integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      

    @push('script')
        <script>
            $(function() {
                var table = $('#table_id').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ Route('dashboard.books.getTrachedDatatable') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },

                        {
                            data: 'price',
                            name: 'price',
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
                                axios.delete(`/dashboard/${id}/book/force-delete`)
                                    .then(res => {
                                        if (res.data.status === true) {
                                            $(`.Row${id}`).remove();
                                            swal({
                                                title: res.data.msg,
                                                icon: "success",
                                            })
                                        } else {
                                            console.error(res.data.msg);
                                            swal({
                                                title: res.data.msg,
                                                icon: "error",
                                            })

                                        }
                                    }).catch(err=>{
                                        console.err(err.data);
                                    })
                                
                            }
                        });

                });

                //Restore
                $(document).on('click', '.restore_btn', function(e) {
                    console.log("hhello from grade ")
                    e.preventDefault();
                    var id = $(this).attr('ajax_id');
                    axios.post(`/dashboard/${id}/book/restore`)
                    .then(res=>{
                        if (res.data.status === true) {
                                $(`.Row${id}`).remove();
                                swal({
                                    title: res.data.msg,
                                    icon: "success",
                                })
                            } else {
                                console.error(res.data.msg);
                                swal({
                                    title: res.data.msg,
                                    icon: "error",
                                })

                            }
                    }).catch(err=>{
                        console.error(err.data);
                    })
                   

                });

                ///Restore All
                $(document).on('click', '.restore_all', function(e) {
                    console.log("hhello from grade ")
                    e.preventDefault();
                    axios.post(`/dashboard/books/restore-all`)
                    .then(res=>{
                        if (res.data.status === true) {
                                $('#table_id').DataTable().draw(false);
                                swal({
                                    title: res.data.msg,
                                    icon: "success",
                                })
                            } else {
                                console.error(res.data.msg);
                                swal({
                                    title: res.data.msg,
                                    icon: "error",
                                })

                            }
                    }).catch(err=>{
                        console.error(err.data);
                    })
                    // $.ajax({
                    //     type: 'POST',
                    //     url: `/dashboard/books/restore-all`,
                    //     data: {
                    //         '_token': '{{ csrf_token() }}',

                    //     },

                    //     success: function(res) {

                    //         if (res.status === true) {
                    //             $('#table_id').DataTable().draw(false);
                    //             swal({
                    //                 title: res.msg,
                    //                 icon: "success",
                    //             })
                    //         } else {
                    //             console.error(res.msg);
                    //             swal({
                    //                 title: res.msg,
                    //                 icon: "error",
                    //             })

                    //         }
                    //     },
                    //     error: function(res) {
                    //         console.error(res);
                    //     }
                    // });

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

                 

                ///edit modal and fill input
                
                $('#modal-show').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var name = button.data('name');
                    var author = button.data('author');
                    var description = button.data('description');
                    var price = button.data('price');
                    var publication = button.data('publication');
                    var category_id = button.data('category_id');
                    var book_id = button.data('id');
                    var modal = $(this);
                    modal.find('#show-name').html(name);
                    modal.find('#show-author').html(author);
                    modal.find('#show-description').html(description);
                    modal.find('#show-price').html(price);
                    modal.find('#show-publication').html(publication);
                    modal.find('#show-category_id').html(category_id);
                    modal.find('#show-book_id').val(book_id);
                });
                //Update Ajax
                // $(document).on('click', '.btn-update', function(e) {
                //     var editBookForm = $('#Edit-form');
                //     var id = $('#book_id').val();

                //     e.preventDefault();
                //     var errorAlert = $('#edit-error-alert');
                //     axios.put(`/dashboard/books/${id}`, $('#Edit-form').serialize())
                //         .then(res => {
                //             toastr.success(res.data.message);
                //             $('#table_id').DataTable().draw(false);
                //         }).catch(error => {

                //             if (error.response.data && error.response.status === 422) {
                //                 const errors = error.response.data.errors;
                //                 let errorMessages = '';

                //                 for (const field in errors) {
                //                     errors[field].forEach(message => {
                //                         errorMessages += `<li>${message}</li>`;
                //                     });
                //                 }

                //                 errorAlert.html(`<ul>${errorMessages}</ul>`);
                //                 errorAlert.show();
                //             } else {
                //                 alert('An error occurred');
                //             }
                //         })
                  

                // });

            })(jQuery);
        </script>
    @endpush
@endsection
