@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
             $.ajax({
                type:       'GET',
                url:        "{{ url('customers') }}/"+ $('#customer_id').val(),
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

            $.ajax({
                type:       'GET',
                url:        "{{ url('products') }}/"+ $('#product_id').val(),
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
                    $('#p_product_name').val(result.title);
                    $('#p_brand_name').val(result.brand_id.name);
                    $('#brand_name').text(result.brand_id.name);
                    $('#category_name').text(result.category_id.name);
                    $('#p_category_name').val(result.category_id.name);
                    $('#product_price').text((result.selling_price) ? parseFloat(result.selling_price).toFixed(2) : '0.00');
                    $('#p_product_price').val((result.selling_price) ? parseFloat(result.selling_price).toFixed(2) : '0.00');
                    var img = (result.featured_src) ? result.featured_src : (result.images.length > 0 ? result.images[0]['src'] : '');
                    if (img) {
                        $('#product_image').html("<img src='"+img+"' style='width:100%;'>");
                        $('#p_product_image').val(img);
                    }
                    swal.close();
                }   
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
                        $('#p_product_name').val(result.title);
                        $('#p_brand_name').val(result.brand_id.name);
                        $('#brand_name').text(result.brand_id.name);
                        $('#category_name').text(result.category_id.name);
                        $('#p_category_name').val(result.category_id.name);
                        $('#product_price').text((result.selling_price) ? parseFloat(result.selling_price).toFixed(2) : '0.00');
                        $('#p_product_price').val((result.selling_price) ? parseFloat(result.selling_price).toFixed(2) : '0.00');
                        var img = (result.featured_src) ? result.featured_src : (result.images.length > 0 ? result.images[0]['src'] : '');
                        if (img) {
                            $('#product_image').html("<img src='"+img+"' style='width:100%;'>");
                            $('#p_product_image').val(img);
                        }
                        swal.close();
                    }   
                });     
            });

            //location.href = '?invoice_type=' + $('#invoice_type').val();

            $('#invoice_type').on('change', function() {
                location.href = '?invoice_type=' + $(this).val();
            });
        });    
    </script>
@endpush
