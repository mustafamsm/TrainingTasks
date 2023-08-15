@extends('layouts.dashboard')
@php
    $curan = LaravelLocalization::getCurrentLocale();
@endphp
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
        <div id="modal-box">

        </div>
    </div>




    @push('script')
         
        <script>
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
                            data: 'title_' + '{{ $curan }}',
                            name: 'title_' + '{{ $curan }}'
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
                                    }).catch(res => {
                                        console.error(res.data);
                                    });


                            }
                        });

                });

               


                ///Add Ajax 
                $(document).on('click', '.btn-submit', function(e) {

                    e.preventDefault();

                    var errorAlert = $('#error-alert');
                    errorAlert.empty();
                    errorAlert.hide();

                    var form = $('#form')[0];
                    var formData = new FormData(form);

                 //append the image to the form data to send it to the server using the uniq id from filepond
                 if (pond_id != 0) {
                        formData.append('image', pond_id);
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
                    
                    e.preventDefault();
                    
                        axios.get(`/{{ $curan }}/dashboard/silders/create`)
                            .then(res => {
                                $('.modal-backdrop').remove();
                                $('#modal-box').empty();
                                $
                                $('#modal-box').append(res.data.modalContent);
                                // Show the Bootstrap modal
                                $('.modal-add-render').modal('show');
                                
                            }).catch(error => {
                                toastr.error(error.response.data.message);
                            })
                   
                })

              

                $(document).on('click', '.editModalBTn', function(e) {
                     
                    e.preventDefault();
                    var id = $(this).data('id');
                   
                        axios.get(`/{{ $curan }}/dashboard/silders/${id}/edit`)
                            .then(res => {
                                $('.modal-backdrop').remove();
                                $('#modal-box').empty();
                                $('#modal-box').append(res.data.modalContent);
                                $('.modal-edit-render').modal('show');
                                
                            }).catch(error => {
                                toastr.error(error.response.data.message);
                            })
                   
                });

        



                $(document).on('click', '.showBtn', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                  
                        axios.get(`/{{ $curan }}/dashboard/silders/${id}`)
                            .then(res => {
                                $('.modal-backdrop').remove();
                                $('#modal-box').empty();
                                $('#modal-box').append(res.data.modalContent);
                                $('.show-modal-render').modal('show');
                            }).catch(error => {
                                toastr.error(error.response.data.message);
                            })
                    
                });
             

                $(document).on('click', '#btn-update', function(e) {

                    e.preventDefault();
                    var errorAlert = $('#edit-error-alert');
                    

                    id = $('#id').val();
                    var form = $('#Edit-form')[0];
                    var formData = new FormData(form);

                
                    if (pond_id != 0) {
                        formData.append('image', pond_id);
                    }
                    var errorAlert = $('#edit-error-alert');
                    $.ajax({
                        type: 'post',
                        url: `/{{ $curan }}/dashboard/ajaxupdate/${id}`,
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(response) {
                            toastr.success(response.message);
                            $('#table_id').DataTable().draw(false);

                            $('#modal-box').empty();
                            // $('.modal-edit-render').modal('hide');
                            $('.modal-backdrop').remove();
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
