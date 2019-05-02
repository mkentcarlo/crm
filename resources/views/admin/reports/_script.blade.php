@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {

            $reportTable = $('#report-table').DataTable( {
                serverSide: true,
                processing: true,
                ajax: {
                    url: "{{ route('get.reports') }}",
                    type:  'get',
                    data:  function (d) {
                        d.current = $('body').find('#current').val();
                        d.year = $('body').find('#select-year').val();
                        d.month = $('body').find('#select-month').val();
                        d.week = $('body').find('#select-week').val();
                    },
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

            $('.select-current').on('click', function(e){
                var selected = $(this).attr('id');
  
                var year = ($('#select-year').val() == '') ? '' : '&year=' + $('#select-year').val();
                var month = ($('#select-month').val() == '') ? '' : '&month=' +$('#select-month').val();
                var week = ($('#select-week').val() == '') ? '' : '&week=' +$('#select-week').val();
                if (selected == 'year') {
                   
                    location.href = '/reports?current=year'+ month + week;
                } 
                else if(selected == 'month'){
                    location.href = '/reports?current=month' + year + week;
                } 

                else if(selected == 'week'){
                    location.href = '/reports?current=week' + year + month;
                }
            });

            $('#select-month').on('change', function(e){
                var current = $('#current').val();
                var month = ($(this).val() == '') ? '' : '&month=' + $(this).val();
                var year = ($('#select-year').val() == '') ? '' : '&year=' +$('#select-year').val();
                var week = ($('#select-week').val() == '') ? '' : '&week=' +$('#select-week').val();
                if (current == 'month' || current == '') {
                    location.href = '/reports' + month + year + week;
                } else {
                    if (current == 'year') {
                        location.href = '/reports?current=year'+ month + week;
                    } 

                    else if(current == 'week'){
                        location.href = '/reports?current=week' + year + month;
                    }
                }
            });

            $('#select-week').on('change', function(e){

                var current = $('#current').val();
                var week = ($(this).val() == '') ? '' : '&week=' + $(this).val();
                var year = ($('#select-year').val() == '') ? '' : '&year=' +$('#select-year').val();
                var month = ($('#select-month').val() == '') ? '' : '&month=' +$('#select-month').val();
                if (current == 'week' || current == '') {
                    location.href = '/reports' + weel + year + month;
                } else {
                    if (current == 'year') {
                        location.href = '/reports?current=year'+ month + week;
                    } 

                    else if(current == 'month'){
              
                        location.href = '/reports?current=month' + year + week;
                    }
                }
            });

            $('#select-year').on('change', function(e){
                var current = $('#current').val();
                var year = ($(this).val() == '') ? '' : '&year=' + $(this).val();
                var week = ($('#select-week').val() == '') ? '' : '&week=' +$('#select-week').val();
                var month = ($('#select-month').val() == '') ? '' : '&month=' +$('#select-month').val();
                if (current == 'year' || current == '') {
                    location.href = '/reports' + year + week + month;
                } else {
                    if (current == 'week') {
                        location.href = '/reports?current=week'+ month + year;
                    } 

                    else if(current == 'month'){
                        location.href = '/reports?current=month' + week + year;
                    }
                }
            });
        });    
    </script>
@endpush
