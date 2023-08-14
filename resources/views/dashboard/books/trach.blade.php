@extends('layouts.dashboard')
@section('breadCrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('dashboard.index') }}">@lang('site.dashboard')</a></li>
    <li class="breadcrumb-item "><a href="{{ route('dashboard.books.index') }}">@lang('site.books')</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.books.trached') }}">@lang('site.trash')</a></li>
@endsection
@php
    $curan = LaravelLocalization::getCurrentLocale();
@endphp
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


                    <label>@lang('site.name_ar') </label>
                    <p id="show-name_ar"></p>
                    <label>@lang('site.name_en') </label>
                    <p id="show-name_en"></p>
                    <label>@lang('site.author'): </label>
                    <p id="show-author"></p>
                    <label>@lang('site.price'): </label>
                    <p id="show-price"></p>
                    <label>@lang('site.publication'): </label>
                    <p id="show-publication"></p>
                    <label>@lang('site.category'): </label>
                    <p id="show-category_id"></p>
                    <label>@lang('site.description_ar'): </label>
                    <p id="show-description_ar"></p>
                    <label>@lang('site.description_en'): </label>
                    <p id="show-description_en"></p>


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
                            data: 'name_' + `{{ $curan }}`,
                            name: 'name_' + `{{ $curan }}`
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
                                axios.delete(`/{{ $curan }}/dashboard/${id}/book/force-delete`)
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
                                    }).catch(err => {
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
                    axios.post(`/{{ $curan }}/dashboard/${id}/book/restore`)
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
                        }).catch(err => {
                            console.error(err.data);
                        })


                });

                ///Restore All
                $(document).on('click', '.restore_all', function(e) {
                    console.log("hhello from grade ")
                    e.preventDefault();
                    axios.post(`/{{ $curan }}/dashboard/books/restore-all`)
                        .then(res => {
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
                        }).catch(err => {
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
                    var name_ar = button.data('name_ar');
                    var name_en = button.data('name_en');
                    var author = button.data('author');
                    var description_ar = button.data('description_ar');
                    var description_en = button.data('description_en');
                    var price = button.data('price');
                    var publication = button.data('publication');
                    var category_id = button.data('category_id');
                    var book_id = button.data('id');
                    var modal = $(this);
                    modal.find('#show-name_ar').html(name_ar);
                    modal.find('#show-name_en').html(name_en);
                    modal.find('#show-author').html(author);
                    modal.find('#show-description_ar').html(description_ar);
                    modal.find('#show-description_en').html(description_en);
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
