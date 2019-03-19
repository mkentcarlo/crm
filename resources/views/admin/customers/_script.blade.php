@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
            $customersTable = $('#customers-table').DataTable( {
                serverSide: true,
                processing: true,
                ajax: "{{ route('get.customers') }}",
                dom: 'lBfrtip',
                buttons: true,
                columns: [
                    {data: "id", name: "id"}, 
                    {data: "name", name: "name"}, 
                    {data: "email", name: "email"}, 
                    {data: "contact", name: "contact"}, 
                    {data: "group_name", name: "group_name"}, 
                    {data: "created_at", name: "created_at"},
                    {data: "action", name: "action"}

                ]
            } );

            $('#filterForm').on('submit', function (e) {
                e.preventDefault();
                 $customersTable.columns(1).search($('#name').val()).draw();
            });

            $('#create_customer').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type:       'POST',
                    url:        "{{ route('store.customer') }}",
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
                                $customersTable.ajax.reload( null, false );
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
                $.getJSON("{{ url('customers') }}/edit/" + id, function (result) {
                    if (result.hasOwnProperty('permitted') && !result.permitted) {
                        swal({
                            type: 'error',
                            title: result.msg,
                            animation: true,
                            showConfirmButton: true,
                        });
                    } else {
                        $('#id').val(result.id);
                        $('#firstname').val(result.firstname);
                        $('#lastname').val(result.lastname);
                        $('#email').val(result.email);
                        $('#contact').val(result.contact);
                        $('#group_id').val(result.group.id);
                        $('#street_address').val(result.street_address);
                        $('#city').val(result.city);
                        $('#state').val(result.state);
                        $('#postal_code').val(result.postal_code);
                        $('#country').val(result.country);
                        $('#updateModal').modal('show');
                        swal.close();
                    }
                });

            });  

            $('#update_customer').submit(function (e) {
                e.preventDefault();
        
                $.ajax({
                    type:       'POST',
                    url:        "{{ url('customers/edit') }}/" + $('#id').val(),
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
                            $customersTable.ajax.reload( null, false );
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
                    text: "You are about to delete this customers!",   
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
                                $customersTable.ajax.reload( null, false );
                            }    
                        } 
                    }); 
                });
            });
        });    
    </script>
@endpush