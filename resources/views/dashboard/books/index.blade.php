@extends('layouts.dashboard')

@php
    $curan = LaravelLocalization::getCurrentLocale();
@endphp

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
                        <table class="table display responsive nowrap" style="width:100%" id="table_id">
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
        <div id="model-box">

        </div>
    </div>








    @push('script')
        <script>
            $(document).ready(function() {
                // get all books using yajra datatables
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
                            data: 'name_' + '{{ $curan }}',
                            name: 'name_' + '{{ $curan }}'
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

                // ============================================================

                $(document).on('click', '#add-btn', function(e) {
                    this.disabled = true;
                    e.preventDefault();

                    axios.get(`/{{ $curan }}/dashboard/books/create`)
                        .then(res => {
                            $('.modal-backdrop').remove();
                            $('#model-box').empty();
                            $('#model-box').append(res.data.modalContent);
                            // Show the Bootstrap modal
                            $('.modal-add-render').modal('show');
                            this.disabled = false;
                        }).catch(error => {

                            toastr.error(error.response.data.message);
                        })

                })

                $(document).on('click', '.editModalBTn', function(e) {
                    
                    e.preventDefault();
                    var id = $(this).data('id');

                    axios.get(`/{{ $curan }}/dashboard/books/${id}/edit`)
                        .then(res => {
                            $('.modal-backdrop').remove();
                            $('#model-box').empty();
                            $('#model-box').append(res.data.modalContent);
                            $('.modal-edit-render').modal('show');
                            
                        }).catch(error => {
                            toastr.error(error.response.data.message);
                        })


                });

                $(document).on('click', '.showBtn', function(e) {
                    this.disabled = true;
                    e.preventDefault();
                    var id = $(this).data('id');

                    axios.get(`/{{ $curan }}/dashboard/books/${id}`)
                        .then(res => {
                            $('.modal-backdrop').remove();
                            $('#model-box').empty();
                            $('#model-box').append(res.data.modalContent);
                            $('.show-modal-render').modal('show');
                            this.disabled = false;
                        }).catch(error => {
                            toastr.error(error.response.data.message);
                        })

                });


               




                // ============================================================
                // submit form

                $(document).on('click', '.btn-submit', function(e) {
                    e.preventDefault();
                    let errorAlert = $('#error-alert');
                    errorAlert.empty();
                    errorAlert.hide();

                    var form = $('#form-add')[0];
                    let formData = new FormData(form);
                    //append the image to the form data to send it to the server using the uniq id from filepond
                    if (pond_id != 0) {
                        formData.append('image', pond_id);
                    }

                    axios.post('/{{ $curan }}/dashboard/books',
                            formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            }
                        )
                        .then(res => {
                            toastr.success(res.data.message);
                            $('#form-add').trigger('reset');
                            $('#add-modal').modal('hide');
                            $('#table_id').DataTable().draw(false);
                        }).catch(error => {
                            console.log(error);
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
            });
            $(document).on('click', '.btn-update', function(e) {
                e.preventDefault();
                var form = $('#Edit-form')[0];
                var id = $('#book_id').val();


                let formData = new FormData(form);
                //append the image to the form data to send it to the server using the uniq id from filepond
                if (pond_id != 0) {
                    formData.append('image', pond_id);
                }
                var errorAlert = $('#edit-error-alert');
                axios.put(`/{{ $curan }}/dashboard/books/${id}`, $('#Edit-form').serialize())
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
            ///Delete
            $(document).on('click', '.delete_btn', function(e) {
                e.preventDefault();
                var id = $(this).attr('ajax_id');
                console.log(id);
                swal({
                        title: "{{ __('site.are_you_sure') }}",
                        icon: 'warning',
                        buttons: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    })
                    .then((value) => {
                        if (value) {

                            axios.delete(`/{{ $curan }}/dashboard/books/${id}`)
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
        </script>
    @endpush
@endsection
