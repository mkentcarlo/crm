@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
            $categoriesTable = $('#categories-table').DataTable( {
                serverSide: true,
                processing: true,
                ajax: "{{ route('get.categories') }}",
                dom: 'lBfrtip',
                buttons: true,
                columns: [
                    {data: "name", name: "name"}, 
                    {data: "action", name: "action"}
                ]
            } );

            $('#create_category').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    type:       'POST',
                    url:        "{{ route('store.category') }}",
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
                            $categoriesTable.ajax.reload( null, false );
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
                $.getJSON("{{ url('categories') }}/edit/" + id, function (result) {
                    $('#id').val(result.id);
                    $('#name').val(result.name);
                    $('#updateModal').modal('show');
                    swal.close();
                });

            });  

           $('#update_category').submit(function (e) {
                e.preventDefault();
        
                $.ajax({
                    type:       'POST',
                    url:        "{{ url('categories/edit') }}/" + $('#id').val(),
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
                            $categoriesTable.ajax.reload( null, false );
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
                    text: "You are about to delete this category!",   
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
                            swal("Deleted!",data.msg, data.type); 
                            $categoriesTable.ajax.reload( null, false );
                        } 
                    }); 
                });
            });
        }); 

          
    </script>
@endpush