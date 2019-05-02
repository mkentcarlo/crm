@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {

            $invoiceTable = $('#invoice-table').DataTable( {
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('get.invoices') }}",
                    type:  'get',
                    data:  function (d) {
                        d.invoice_type = $('body').find('#select-invoice').val();
                    },
                    error: function (xhr, err) {
                        if (err === 'parsererror') {
                            location.reload();
                        }
                    }
                },
                dom: 'lBfrtip',
                buttons: true,
                columns: [
                    {data: "id", name: "id"}, 
                    {data: "invoice_type", name: "invoice_type"}, 
                    {data: "total_amount", name: "total_amount"}, 
                    {data: "status", name: "status"}, 
                    {data: "created_at", name: "created_at"}, 
                    {data: "due_date", name: "due_date"}, 
                    {data: "action", name: "action"}
                ]
            } );

            $('#select-invoice').on('change', function () {
                $invoiceTable.draw();
            });

            $('body').on('keypress', '#invoice_id', function () {
                $invoiceTable.columns(0).search($(this).val()).draw();
            });

            $('#customer_id').on('change', function(){
                $.ajax({
                    type:       'GET',
                    url:        "{{ url('customers') }}/"+ $(this).val(),
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
                        $('#street_address').text(result.street_address);
                        swal.close();
                    }   
                });     
            });

            $('#product_id').on('change', function(){
                $.ajax({
                    type:       'GET',
                    url:        "{{ url('products') }}/"+ $(this).val(),
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
                        $('#product_name').text(result.title);
                        $('#brand_name').text(result.brand_id.name);
                        $('#category_name').text(result.category_id.name);
                        $('#product_price').text(parseFloat(result.price).toFixed(2));
                        var img = (result.featured_src) ? result.featured_src : (result.images.length > 0 ? result.images[0]['src'] : '');
                        if (img) {
                            $('#product_image').html("<img src='"+img+"' style='width:100%;'>");
                        }
                        swal.close();
                    }   
                });     
            });
            var total = 0;
            $('.product-overview tbody tr').each(function() {
                total += parseInt($(this).find('td:eq(6) span').text());
            });
            $('#subtotal').text(total.toFixed(2));
                
            $('#add_quantity').on('click', function(){
                var img_src = $('#product_image img').attr('src');
                var product_name = $('#product_name').text();
                var brand_name = $('#brand_name').text();
                var category_name = $('#category_name').text();
                var product_price = $('#product_price').text();
                var quantity = $('#quantity').val();
                var product_id = $('#product_id').val();
                var sub_total = parseFloat(product_price) * quantity;
            
                if ($('.product-overview tbody').find('tr#'+product_id).length > 0) {
                   var currentQty = $('.product-overview tbody').find('tr#'+product_id+' td:eq(5)').text();
                   var totalQty = parseInt(currentQty)+ parseInt(quantity);
                   var productPrice = $('.product-overview tbody').find('tr#'+product_id+' td:eq(4)').text();
                   var currentSubTotal = $('.product-overview tbody').find('tr#'+product_id+' td:eq(6) span').text();
                   var subTotal = parseInt(productPrice) * parseInt(totalQty);
                   $('.product-overview tbody').find('tr#'+product_id+' td:eq(5) span').text(totalQty);
                   $('.product-overview tbody').find('tr#'+product_id+' td:eq(5) input').val(totalQty);
                   $('.product-overview tbody').find('tr#'+product_id+' td:eq(6) input').val(subTotal.toFixed(2));
                   $('.product-overview tbody').find('tr#'+product_id+' td:eq(6) span').text(subTotal.toFixed(2));
                } else {
                    $('.product-overview tbody').append("<tr id="+product_id+"><td><input type='hidden' name='product_id[]' value="+product_id+"><input type='hidden' name='featured_src[]' value="+img_src+"><img src='"+img_src+"' width='80'></td><td><input type='hidden' name='product_name[]' value="+product_name+">"+product_name+"</td><td><input type='hidden' name='brand_name[]' value="+brand_name+">"+brand_name+"</td><td><input type='hidden' name='category_name[]' value="+category_name+">"+category_name+"</td><td><input type='hidden' name='product_price[]' value="+product_price+">"+product_price+"</td><td class='quantity'><input type='hidden' name='quantity[]' value="+quantity+">"+quantity+"</td><td class='subtotal'><input type='hidden' name='sub_total_amount[]' value="+sub_total.toFixed(2)+">$<span>"+sub_total.toFixed(2)+"</span></td><td><a href='javascript:void(0)' class='delete' title=' data-toggle='tooltip' data-original-title='Delete'><i class='zmdi zmdi-delete txt-warning'></i></a></td></tr>");
                }

                var total = 0;
                $('.product-overview tbody tr').each(function() {
                    total += parseInt($(this).find('td:eq(6) span').text());
                });
                $('#subtotal').text(total.toFixed(2));
                $('.total_amount').val(total.toFixed(2));
                $('.total_amount').text(total.toFixed(2));
            }); 
            
            var ids = [];

            $(document).on('click','.delete-product-invoice', function(e){
                e.preventDefault();
                $(this).parent().parent().detach();
                

                if ($(this).is("[ino]")) {
                    ids.push($(this).attr('ino'));
                }
                $('#remove_ids').val(ids);
            });


            $('.payment_method').on('click', function(){
                var val = $(this).val();
                if ($(this).hasClass('checked')) {
                    $(this).removeClass('checked');
                    $('#' + val).hide();
                } else {
                    $('#' + val).show();
                    $(this).addClass('checked');
                }
            });

            $('.add-more-card').on('click', function(e){
                e.preventDefault();

                // $('#credit_card_holder').append('<div class="card-holder ml-15 mt-15"><button type="button" class="remove-card">remove</button><label>Card Name</label><input type="text" name="card_name[]" class="form-control"><label>Card Number</label><input type="text" name="card_number[]" class="form-control"><label>Amount</label><input type="text" name="card_amount[]" class="form-control"></div>');

                $('#credit_card_holder').append('<tr> <td><input type="text" name="card_name[]" class="form-control"></td> <td><input type="text" name="card_number[]" class="form-control"></td> <td><input type="text" name="card_amount[]" class="form-control"></td> <td><button type="button" class="remove-card btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td> </tr>');                
            });

            $(document).on('click', '.remove-card', function(e){
                e.preventDefault();
                $(this).parent().parent().detach();
            });

            $('#discount').on('keypress', function() {
                var tax = parseFloat($('#tax').val());
                var subTotal = parseFloat($('#subtotal').text());
                var discount = parseFloat($(this).val());
            });

            //location.href = '?invoice_type=' + $('#invoice_type').val();

            $('#invoice_type').on('change', function() {
                location.href = '?invoice_type=' + $(this).val();
            });

            $('.included').on('click', function(){
                var val = $(this).val();
                if ($(this).hasClass('checked')) {
                    $(this).removeClass('checked');
                    $('#' + val).hide();
                } else {
                    $('#' + val).show();
                    $(this).addClass('checked');
                }
            });

            $(document).on('click', 'a.delete', function(e){
                e.preventDefault();
                $del_btn = $(this);
                swal({   
                    title: "Are you sure?",   
                    text: "You are about to delete this invoice!",   
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
                                $invoiceTable.ajax.reload( null, false );
                            }    
                        } 
                    }); 
                });
            });
        });    
    </script>
@endpush
