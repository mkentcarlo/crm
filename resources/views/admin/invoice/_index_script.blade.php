@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
            var type = "{{ $invoice }}";
            var start = "{{ $start }}";
            var end = "{{ $end }}";
            $invoiceTable = $('#invoice-table').DataTable( {
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('get.invoices') }}",
                    type:  'get',
                    data:  function (d) {
                        d.current = $('body').find('#current').val();
                        d.year = $('body').find('#select-year').val();
                        d.month = $('body').find('#select-month').val();
                        d.week = $('body').find('#select-week').val();
                        d.date_start = start;
                        d.date_end = end;
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

            $('.select-current').on('click', function(e){
                var selected = $(this).attr('id');
  
                var year = ($('#select-year').val() == '') ? '' : '&year=' + $('#select-year').val();
                var month = ($('#select-month').val() == '') ? '' : '&month=' +$('#select-month').val();
                var week = ($('#select-week').val() == '') ? '' : '&week=' +$('#select-week').val();
                if (selected == 'year') {
                   
                    location.href = '/invoice?invoice_type='+type+'&current=year';
                } 
                else if(selected == 'month'){
                    location.href = '/invoice?invoice_type='+type+'&current=month';
                } 

                else if(selected == 'week'){
                    location.href = '/invoice?invoice_type='+type+'&current=week';
                }
            });

            $('#select-month').on('change', function(e){
                var current = $('#current').val();
                var month = ($(this).val() == '') ? '' : '&month=' + $(this).val();
                var year = ($('#select-year').val() == '') ? '' : '&year=' +$('#select-year').val();
                if (current == 'month' || current == '') {
                    month = ($(this).val() == '') ? '' : '&month=' + $(this).val();
                    var url = (month == '') ? '&year=' + $('#select-year').val() + week : '&month=' + $(this).val() + year + week;
                    location.href = '/invoice?invoice_type='+type + url;
                } else {
                    if (current == 'year') {
                        location.href = '/invoice?invoice_type='+type+'&current=year'+ month + week;
                    } 

                    else if(current == 'week'){
                        location.href = '/invoice?invoice_type='+type+'&current=week' + year + month;
                    }
                }
            });

            $('#select-week').on('change', function(e){

                var current = $('#current').val();
                var week = ($(this).val() == '') ? '' : '&week=' + $(this).val();
                var year = ($('#select-year').val() == '') ? '' : '&year=' +$('#select-year').val();
                var month = ($('#select-month').val() == '') ? '' : '&month=' +$('#select-month').val();
                if (current == 'week' || current == '') {
                    week = ($(this).val() == '') ? '' : '?week=' + $(this).val();

                    var url = (week == '') ? '?year=' + $('#select-year').val() + month : '?week=' + $(this).val() + year + month;
                    location.href = '/invoice' + url;
                } else {
                    if (current == 'year') {
                        location.href = '/invoice?invoice_type='+type+'&current=year'+ month + week;
                    } 

                    else if(current == 'month'){
              
                        location.href = '/invoice?current=month' + year + week;
                    }
                }
            });

            $('#select-year').on('change', function(e){
                var current = $('#current').val();
                var year = ($(this).val() == '') ? '' : '&year=' + $(this).val();
                var week = ($('#select-week').val() == '') ? '' : '&week=' +$('#select-week').val();
                var month = ($('#select-month').val() == '') ? '' : '&month=' +$('#select-month').val();
                if (current == 'year' || current == '') {
                    year = ($(this).val() == '') ? '' : '&year=' + $(this).val();
                    location.href = '/invoice?invoice_type='+type+'' + year + week + month;

                    var url = (year == '') ? '&month=' + $('#select-month').val() + week : '&year=' + $(this).val() + month + week;
                    location.href = '/invoice?invoice_type='+type + url;
                } else {
                    if (current == 'week') {
                        location.href = '/invoice?invoice_type='+type+'&current=week'+ month + year;
                    } 

                    else if(current == 'month'){
                        location.href = '/invoice?invoice_type='+type+'&current=month' + week + year;
                    }
                }
            });
        });
    </script>
@endpush
        
