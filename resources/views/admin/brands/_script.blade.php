@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
            $brandsTable = $('#brands-table').DataTable( {
                serverSide: true,
                processing: true,
                ajax: "{{ route('get.brands') }}",
                dom: 'lBfrtip',
                buttons: true,
                columns: [
                    {data: "name", name: "name"}, 
                    {data: "action", name: "action"}
                ]
            } );

            $('#create_brand').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type:       'POST',
                    url:        "{{ route('create.brand') }}",
                    data:       $(this).serialize(),
                    dataType:   'json',
                    beforeSend: function () {
                        swal({
                            title: 'Loading...',
                            imageUrl: "{{ asset('img/loader.gif') }}",
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Custom image',
                            animation: true,
                            showConfirmButton: false,
                        });
                    },
                    success:    function (result) {
                        if (result.hasOwnProperty('permitted') && !result.permitted) {
                            swal({
                                type: 'error',
                                title: result.msg,
                                animation: true,
                                showConfirmButton: true,
                            });
                        } else {
                            if (result.success) {
                                successMsg(result.msg);
                                $('#createModal').modal('hide');
                                $brandsTable.ajax.reload( null, false );
                            } else {
                                errorMsg(result.msg);
                            }  
                        }    
                    },
                    error:      function (errors) {
                        errorMsg(errors.responseJSON.errors);
                    }
                });
            });

            $('body').on('click', '.edit', function (e) {
                e.preventDefault();

                swal({
                    title: 'Loading...',
                    imageUrl: "{{ asset('img/loader.gif') }}",
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                    animation: true,
                    showConfirmButton: false,
                });

                var id = $(this).attr('id');
                $.getJSON("{{ url('brands') }}/edit/" + id, function (result) {
                    if (result.hasOwnProperty('permitted') && !result.permitted) {
                        swal({
                            type: 'error',
                            title: result.msg,
                            animation: true,
                            showConfirmButton: true,
                        });
                    } else {
                        $('#id').val(result.term_id);
                        $('#name').val(result.name);
                        $('#updateModal').modal('show');
                        swal.close();
                    }
                });

            });  

           $('#update_brand').submit(function (e) {
                e.preventDefault();
        
                $.ajax({
                    type:       'POST',
                    url:        "{{ url('brands/edit') }}/" + $('#id').val(),
                    data:       $(this).serialize(),
                    dataType:   'json',
                    beforeSend: function () {
                        swal({
                            title: 'Loading...',
                            imageUrl: "{{ asset('img/loader.gif') }}",
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Custom image',
                            animation: true,
                            showConfirmButton: false,
                        });
                    },
                    success:    function (result) {
                        if (result.success) {
                            successMsg(result.msg);
                            $('#updateModal').modal('hide');
                            swal.close();
                            $brandsTable.ajax.reload( null, false );
                        } else {
                            errorMsg(result.msg);
                        }  
                    },
                    error:      function (errors) {
                        errorMsg(errors.responseJSON.errors);
                    }
                });
            });

           $(document).on('click', 'a.delete', function(e){
                e.preventDefault();
                $del_btn = $(this);
                swal({   
                    title: "Are you sure?",   
                    text: "You are about to delete this brand!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#f8b32d",   
                    confirmButtonText: "Yes, delete it!",   
                    closeOnConfirm: false 
                }, function(){   
                    $.ajax({
                        url: $del_btn.attr('href'),
                        type: "delete",
                        dataType: "JSON",
                        success: function(data) {
                            if (data.hasOwnProperty('permitted') && !data.permitted) {
                                swal({
                                    type: 'error',
                                    title: data.msg,
                                    animation: true,
                                    showConfirmButton: true,
                                });
                            } else {
                                swal("Deleted!",data.msg, data.type); 
                                $brandsTable.ajax.reload( null, false );
                            }    
                        } 
                    }); 
                });
            });
        }); 
          
    </script>
@endpush
