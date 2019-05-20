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
                     var street_address = (result.street_address != null) ? result.street_address : '';
                        var city = (result.city != null) ? ' ,' + result.city : '';
                        var country = (result.country != null) ? result.country : '';
                        var state = (result.state != null) ? ' ,'+result.state : '';
                        var postal_code = (result.postal_code != null) ? ' '+result.postal_code : '';
                        $('#street_address').text(street_address + city);
                        $('#code_state_country').text(country + state + postal_code);
                    $('#phone').text('P:' + result.contact);
                    $('#email').text(result.email);
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
                      var street_address = (result.street_address != null) ? result.street_address : '';
                        var city = (result.city != null) ? ' ,' + result.city : '';
                        var country = (result.country != null) ? result.country : '';
                        var state = (result.state != null) ? ' ,'+result.state : '';
                        var postal_code = (result.postal_code != null) ? ' '+result.postal_code : '';
                        $('#street_address').text(street_address + city);
                        $('#code_state_country').text(country + state + postal_code);
                    $('#phone').text('P:' + result.contact);
                    $('#email').text(result.email);
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
                    $('#short_description').text(result.short_description);
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
                        $('#short_description').text(result.short_description);
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

            $('.customer-dropdown').select2({matcher: function(params, data){
                // Always return the object if there is nothing to compare
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Check if the data occurs
                if ($(data.element).data('email').toString().indexOf(params.term) > -1) {
                    return data;
                }

                if ($(data.element).data('contact').toString().indexOf(params.term) > -1) {
                    return data;
                }

                // If it doesn't contain the term, don't return anything
                return null;
            } });

            $('.product-dropdown').select2({matcher: function(params, data){
                // Always return the object if there is nothing to compare
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Check if the data occurs
                if ($(data.element).data('title').toString().indexOf(params.term) > -1) {
                    return data;
                }

                if ($(data.element).data('brand').toString().indexOf(params.term) > -1) {
                    return data;
                }

                if ($(data.element).data('desc').toString().indexOf(params.term) > -1) {
                    return data;
                }

                // If it doesn't contain the term, don't return anything
                return null;
            } });
        });    
    </script>
@endpush
