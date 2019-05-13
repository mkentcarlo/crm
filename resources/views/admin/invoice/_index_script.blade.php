@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
            var type = "{{ $invoice }}";
            $invoiceTable = $('#invoice-table').DataTable( {
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('get.invoices') }}",
                    type:  'get',
                    data:  function (d) {
                        d.invoice_type = type; 
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
        });
    </script>
@endpush
        
