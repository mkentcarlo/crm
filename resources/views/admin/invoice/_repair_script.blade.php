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

            //location.href = '?invoice_type=' + $('#invoice_type').val();

            $('#invoice_type').on('change', function() {
                location.href = '?invoice_type=' + $(this).val();
            });
        });    
    </script>
@endpush
