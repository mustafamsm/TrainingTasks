@extends('layouts.dashboard')

@section('breadCrumb')
    @parent
    <li class="breadcrumb-item "><a href="{{ route('dashboard.index') }}">@lang('site.dashboard')</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('dashboard.silders.index') }}">@lang('site.silders')</a></li>
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
                        <i class="fa fa-align-justify"></i> @lang('site.silders') List Table
                        <div class="card-tools">
                            <button type="button" class="btn btn-primary" id="add-btn">
                                @lang('site.add')
                            </button>
                            {{-- <a href="{{ route('dashboard.silders.trached') }}" class="btn btn-default">
                            <i class="fa fa-trash"></i> @lang('site.trash')
                        </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table display responsive nowrap" style="width:100%" id="table_id">
                            <thead>
                                <tr>
                                    <th>@lang('site.id')</th>
                                    <th>@lang('site.title')</th>
                                    <th>@lang('site.status')</th>
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
                    responsive: true,
                    serverSide: true,
                    ajax: "{{ Route('dashboard.silders.getAll') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },

                        {
                            data: 'status',
                            name: 'status',
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
                            title: "{{ __('site.are_you_sure') }}",

                            icon: 'warning',
                            buttons: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        })
                        .then((value) => {
                            if (value) {

                                axios.delete(`/{{ $curan }}/dashboard/silders/${id}`)
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
                        url: `/{{ $curan }}/dashboard/silders/`,
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

                $(document).on('click', '#add-btn', function(e) {
                    this.disabled = true;
                    e.preventDefault();
                    if ($('.modal-add-render').length == 0) {
                        axios.get(`/{{ $curan }}/dashboard/silders/create`)
                            .then(res => {
                                $('body').append(res.data.modalContent);
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
                    e.preventDefault();
                    var id = $(this).data('id');
                    if ($('.modal-edit-render').length == 0) {
                        axios.get(`/{{ $curan }}/dashboard/silders/${id}/edit`)
                            .then(res => {
                                $('body').append(res.data.modalContent);
                                $('.modal-edit-render').modal('show');
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
                    e.preventDefault();
                    var id = $(this).data('id');
                    if ($('.show-modal-render').length == 0) {
                        axios.get(`/{{ $curan }}/dashboard/silders/${id}`)
                            .then(res => {
                                $('body').append(res.data.modalContent);
                                $('.show-modal-render').modal('show');
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
      
    @endpush
@endsection
