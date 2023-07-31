@extends('layouts.dashboard')

@section('breadCrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('dashboard.index') }}">@lang('site.dashboard')</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.books.index') }}">@lang('site.books')</a></li>
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
                        <i class="fa fa-align-justify"></i> @lang('site.books') List Table
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary" id="add-btn">
                                @lang('site.add')
                            </button>
                            <a href="{{ route('dashboard.books.trached') }}" class="btn btn-default">
                                <i class="fa fa-trash"></i> @lang('site.trash')
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table display responsive nowrap" style="width:100%" id="table_id"  >
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
        <div class="modal">

        </div>
    </div>


    <!-- /Edit modal -->
    {{-- <div class="modal edit fade" id="modal-edit">
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
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" id="book_id">
                                <label for="name">@lang('site.name')</label>
                                <input type="text" class="form-control " placeholder="Name Of Category"
                                    name="name" id="name">

                            </div>
                            <div class="form-group">
                                <label for="author">@lang('site.author')</label>
                                <input type="text" class="form-control " placeholder="Name Of Author" name="author"
                                    id="author">

                            </div>
                            <div class="form-group">
                                <label for="price">@lang('site.price')</label>
                                <input type="number" class="form-control " placeholder="price" name="price"
                                    id="price">

                            </div>
                            <div class="form-group">
                                <label for="publication">@lang('site.publication')</label>
                                <input type="date" class="form-control  " name="publication" id="publication">

                            </div>
                            <div class="form-groub">
                                <label for="category_id">@lang('site.category')</label>
                                <select name="category_id" id="category_id" class="form-control  ">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="description">@lang('site.description')</label>
                                <textarea name="description" id="description" class="form-control"> </textarea>

                            </div>
                        </div>
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
    </div> --}}
    <!-- /End Edit modal -->


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"
        integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"
        integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @push('script')
        <!-- JavaScript code to handle AJAX and render the modal -->
        <script>
            axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
            $(function() {
                var table = $('#table_id').DataTable({
                    processing: true,
                    serverSide: true,
                    serverSide: true,
                    ajax: "{{ Route('dashboard.books.getAll') }}",
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
                            name: '@lang('site.action')',
                            orderable: false,
                            searchable: false

                        }
                    ]
                });

            });

            (function($) {
            
                @php
                    $curan = LaravelLocalization::getCurrentLocale();
                @endphp
          
                ///Delete
                $(document).on('click', '.delete_btn', function(e) {

                    e.preventDefault();
                    var id = $(this).attr('ajax_id');
                    console.log(id);
                    swal({
                            title: "{{__('site.are_you_sure')}}",
                         
                            icon: 'warning',
                            buttons: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        })
                        .then((value) => {
                            if (value) {

                                axios.delete(`/{{$curan}}/dashboard/books/${id}`)
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
                                    }).catch(res => {
                                        console.error(res.data);
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
                    tinymce.triggerSave();
                    var addBookForm = $('#form');
                    e.preventDefault();
                    var errorAlert = $('#error-alert');
                    axios.post('/{{ $curan }}/dashboard/books',
                            $('#form').serialize()
                        )
                        .then(res => {
                            toastr.success(res.data.message);
                            addBookForm.trigger('reset');
                            $('#table_id').DataTable().draw(false);
                        }).catch(error => {

                            if (error.response.data && error.response.status === 422) {
                                const errors = error.response.data.errors;
                                let errorMessages = '';

                                for (const field in errors) {
                                    errors[field].forEach(message => {
                                        errorMessages += `<li>${message}</li>`;
                                    });
                                }

                                errorAlert.html(`<ul>${errorMessages}</ul>`);
                                errorAlert.show();
                            } else {
                                alert('An error occurred');
                            }
                        });


                });

                $(document).on('click', '#add-btn', function(e) {
                     this.disabled = true;
                    e.preventDefault();
                    if ($('.modal-add-render').length == 0) {
                        axios.get(`/{{$curan}}/dashboard/books/create`)
                            .then(res => {
                                $('html').append(res.data.modalContent);
                                // Show the Bootstrap modal
                                $('.modal-add-render').modal('show');
                                this.disabled = false;
                            }).catch(error => {
                                toastr.error(error.response.data.message);
                            })
                    } else {
                        $('.modal-add-render').modal('show');
                    }
                })

                $(document).on('hidden.bs.modal', '.modal-add-render', function() {
                    $(this).remove();
                });

                $(document).on('click', '.editModalBTn', function(e) {
                    this.disabled = true;
                    e.preventDefault();
                    var id = $(this).data('id');
                    if ($('.modal-edit-render').length == 0) {
                        axios.get(`/{{$curan}}/dashboard/books/${id}/edit`)
                            .then(res => {
                                $('body').append(res.data.modalContent);
                                $('.modal-edit-render').modal('show');
                                this.disabled = false;
                            }).catch(error => {
                                toastr.error(error.response.data.message);
                            })
                    } else {
                        $('.modal-edit-render').modal('show');
                    }
                });

                $(document).on('hidden.bs.modal', '.modal-edit-render', function() {
                    $(this).remove();
                });



                $(document).on('click', '.showBtn', function(e) {
                    this.disabled = true;
                    e.preventDefault();
                    var id = $(this).data('id');
                    if ($('.show-modal-render').length == 0) {
                        axios.get(`/{{$curan}}/dashboard/books/${id}`)
                            .then(res => {
                                $('body').append(res.data.modalContent);
                                $('.show-modal-render').modal('show');
                                this.disabled = false;
                            }).catch(error => {
                                toastr.error(error.response.data.message);
                            })
                    } else {
                        $('.show-modal-render').modal('show');
                    }
                });
                $(document).on('hidden.bs.modal', '.show-modal-render', function() {
                    $(this).remove();
                });
            })(jQuery);
        </script>
        <script>
            $(document).on('click', '.btn-update', function(e) {
                var editBookForm = $('#Edit-form');
                var id = $('#book_id').val();
                e.preventDefault();
                var errorAlert = $('#edit-error-alert');
                axios.put(`/{{$curan}}/dashboard/books/${id}`, $('#Edit-form').serialize())
                    .then(res => {
                        toastr.success(res.data.message);
                        $('#table_id').DataTable().draw(false);
                    }).catch(error => {
                        if (error.response.data && error.response.status === 422) {
                            const errors = error.response.data.errors;
                            let errorMessages = '';

                            for (const field in errors) {
                                errors[field].forEach(message => {
                                    errorMessages += `<li>${message}</li>`;
                                });
                            }

                            errorAlert.html(`<ul>${errorMessages}</ul>`);
                            errorAlert.show();
                        } else {
                            alert('An error occurred');
                        }
                    })


            });
        </script>

    @endpush
@endsection
