@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function () {
            $(document).on('click','table.other-invoice .add-row', function(e){
                e.preventDefault();
                $("<tr>" + $(this).parent().parent().html() + "</tr>").appendTo('table.other-invoice tbody');
            });
            $(document).on('click','table.other-invoice .delete', function(e){
                e.preventDefault();
                $(this).parent().parent().remove();
                calculateTotal();
            });
            $(document).on('keyup','.amount', function(e){
                calculateTotal();
            });
            function calculateTotal()
            {
                var total = 0;
                $('.amount').each(function(){
                    total += parseFloat($(this).val());
                });
                $('.overall-total').html(total);
            }

        });    
    </script>
@endpush
