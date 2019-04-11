@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
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
                   $('.product-overview tbody').find('tr#'+product_id+' td:eq(5)').text(totalQty);
                   $('.product-overview tbody').find('tr#'+product_id+' td:eq(6) span').text(subTotal.toFixed(2));
                } else {
                    $('.product-overview tbody').append("<tr id="+product_id+"><td><input type='hidden' name='product_id[]' value="+product_id+"><input type='hidden' name='featured_src[]' value="+img_src+"><img src='"+img_src+"' width='80'></td><td><input type='hidden' name='product_name[]' value="+product_name+">"+product_name+"</td><td><input type='hidden' name='brand_name[]' value="+brand_name+">"+brand_name+"</td><td><input type='hidden' name='category_name[]' value="+category_name+">"+category_name+"</td><td><input type='hidden' name='product_price[]' value="+product_price+">"+product_price+"</td><td class='quantity'><input type='hidden' name='quantity[]' value="+quantity+">"+quantity+"</td><td class='subtotal'><input type='hidden' name='sub_total_amount[]' value="+sub_total.toFixed(2)+">$<span>"+sub_total.toFixed(2)+"</span></td><td><a href='javascript:void(0)' class='delete' title=' data-toggle='tooltip' data-original-title='Delete'><i class='zmdi zmdi-delete txt-warning'></i></a></td></tr>");
                }

                var total = 0;
                $('.product-overview tbody tr').each(function() {
                    total += parseInt($(this).find('td:eq(6) span').text());
                });
                $('#subtotal').text(total.toFixed(2));
            }); 
            
            var ids = [];

            $(document).on('click','.delete', function(e){
                e.preventDefault();
                $(this).parent().parent().detach();
                

                if ($(this).is("[ino]")) {
                    ids.push($(this).attr('ino'));
                }
                $('#remove_ids').val(ids);
            });
            
            $('.payment_method').each(function () {
                var val = $(this).val();
                if ($(this).hasClass('checked')) {
                    $(this).removeClass('checked');
                    $('#' + val).hide();
                } else {
                    $('#' + val).show();
                    $(this).addClass('checked');
                }
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

                $('#credit_card_holder').append('<div class="card-holder ml-15 mt-15"><button type="button" class="remove-card">remove</button><label>Card Name</label><input type="text" name="card_name[]" class="form-control"><label>Card Number</label><input type="text" name="card_number[]" class="form-control"><label>Amount</label><input type="text" name="card_amount[]" class="form-control"></div>');

            });

            $(document).on('click', '.remove-card', function(e){
                e.preventDefault();
                $(this).parent().detach();
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
        });    
    </script>
@endpush