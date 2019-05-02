@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
            $rolesTable = $('#roles-table').DataTable( {
                serverSide: true,
                processing: true,
                ajax: "{{ route('get.roles') }}",
                dom: 'lBfrtip',
                buttons: true,
                columns: [
                    {data: "name", name: "name"}, 
                    {data: "permissions", name: "permissions"}, 
                    {data: "created_at", name: "created_at"},
                    {data: "action", name: "action"}

                ]
            } );

            $('#create_role').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type:       'POST',
                    url:        "{{ route('store.role') }}",
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
                            $('#createModal').modal('hide');
                            $rolesTable.ajax.reload( null, false );
                        } else {
                            errorMsg(result.msg);
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
                $.getJSON("{{ url('roles') }}/edit/" + id, function (result) {
                            
                    if (result.hasOwnProperty('permitted') && !result.permitted) {
                        swal({
                            type: 'error',
                            title: result.msg,
                            animation: true,
                            showConfirmButton: true,
                        });
                    } else {

                        let selector = $('#update_role').find('input[type="checkbox"]');
                        for (let i = 0; i < selector.length; i++) {
                            if(result.permissions.indexOf(selector[i].value) != -1) {
                                selector[i].checked = true;
                            }
                        }
                        $('#id').val(result.info.id);
                        if (result.info.name == 'admin') {
                            $('#name').val('admin');
                            $('#name').prop('readonly', true);
                        } else {
                            $('#name').val(result.info.name);
                            $('#name').prop('readonly', false);
                        }
                        
                        $('#updateModal').modal('show');
                        swal.close();
                    }
                });
            });  

            $('#update_role').submit(function (e) {
                e.preventDefault();
        
                $.ajax({
                    type:       'POST',
                    url:        "{{ url('roles/edit') }}/" + $('#id').val(),
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
                            $rolesTable.ajax.reload( null, false );
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
                    text: "You are about to delete this role!",   
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
                                $rolesTable.ajax.reload( null, false );
                            }    
                        } 
                    }); 
                });
            });
        }); 
          
    </script>
@endpush
