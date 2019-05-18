@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {

            $reportTable = $('#transaction-table').DataTable( {
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('get.transactions') }}"
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
        });    
    </script>
@endpush
