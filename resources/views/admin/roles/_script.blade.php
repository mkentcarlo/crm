@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function () {
            $rolesTable = $('#roles-table').DataTable( {
                serverSide: true,
                processing: true,
                ajax: "{{ route('get.roles') }}",
                dom: 'lBfrtip',
                buttons: true,
                columns: [
                    {data: "name", name: "name"}, 
                    {data: "created_at", name: "created_at"},
                    {data: "action", name: "action"}

                ]
            } );
        }); 
          
    </script>
@endpush
