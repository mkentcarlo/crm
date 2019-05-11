@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
            $groupsTable = $('#groups-table').DataTable( {
                serverSide: true,
                processing: true,
                ajax: "{{ route('get.groups') }}",
                dom: 'lBfrtip',
                buttons: true,
                columns: [
                    {data: "name", name: "name"}, 
                    {data: "created_at", name: "created_at"},
                    {data: "action", name: "action"}

                ]
            } );

            $('#create_group').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type:       'POST',
                    url:        "{{ route('store.group') }}",
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
                                $groupsTable.ajax.reload( null, false );
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

            // $('body').on('click', '.edit', function (e) {
            //     e.preventDefault();

            //     swal({
            //         title: 'Loading...',
            //         imageUrl: "{{ asset('img/loader.gif') }}",
            //         imageWidth: 400,
            //         imageHeight: 200,
            //         imageAlt: 'Custom image',
            //         animation: true,
            //         showConfirmButton: false,
            //     });

            //     var id = $(this).attr('id');
            //     $.getJSON("{{ url('groups') }}/edit/" + id, function (result) {
            //         if (result.hasOwnProperty('permitted') && !result.permitted) {
            //             swal({
            //                 type: 'error',
            //                 title: result.msg,
            //                 animation: true,
            //                 showConfirmButton: true,
            //             });
            //         } else {
            //             $('#id').val(result.id);
            //             $('#name').val(result.name);
            //             $('#sub_group').val(result.sub_group);
            //             $('#updateModal').modal('show');
            //             swal.close();
            //         }
            //     });

            // });  

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
                $('#sub_group2').html('<option value="0">No Parent Group</option>');
                var id = $(this).attr('id');
                $.getJSON("{{ url('groups') }}/edit/" + id, function (result) {
                    if (result.hasOwnProperty('permitted') && !result.permitted) {
                        swal({
                            type: 'error',
                            title: result.msg,
                            animation: true,
                            showConfirmButton: true,
                        });
                    } else {
                        $('#id').val(result.id);
                        $('#name').val(result.name);
                        var subgroup = result.sub_group;
                        $.getJSON("{{ url('groups/all') }}", function (result) {
                            $.each(result, function (i, item) {
                                $('#sub_group2').append($('<option>', { 
                                    value: item.id,
                                    text : item.name 
                                }));
                            });
                            $('#sub_group2').val(subgroup);
                            $('#updateModal').modal('show');
                            swal.close();
                        }); 
                    }    
                });

            });  

           $('#update_group').submit(function (e) {
                e.preventDefault();
        
                $.ajax({
                    type:       'POST',
                    url:        "{{ url('groups/edit') }}/" + $('#id').val(),
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
                            $groupsTable.ajax.reload( null, false );
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
                    text: "You are about to delete this group!",   
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
                                var message = 'This group is being used by some contacts. Cannot delete it!';
                                var info = (message == data.msg) ? 'Note!' : 'Deleted!';
                                swal(info,data.msg, data.type); 
                                $groupsTable.ajax.reload( null, false );
                            }    
                        } 
                    }); 
                });
            });

           $('#add-group').on('click', function(e){
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
                $('#sub_group').html('<option value="0">No Parent Group</option>');
                $.getJSON("{{ url('groups/all') }}", function (result) {
                        $.each(result, function (i, item) {
                            $('#sub_group').append($('<option>', { 
                                value: item.id,
                                text : item.name 
                            })); 
                        });
                        $('#createModal').modal('show');
                        swal.close();  
                });
           });
        }); 
          
    </script>
@endpush
