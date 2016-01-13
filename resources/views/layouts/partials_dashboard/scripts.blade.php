<script src="/assets/js/admin.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<script>
    $(function() {
        $('#items-table').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json",
                "thousands": ","
            },
            processing: true,
            serverSide: true,
            searchable:true,
            ajax: '{!! route('datatables.data') !!}',
            columns: [
                {data: 'rownum', name: 'rownum'},
                { data: 'name', name: 'name' },
                { data: 'number', name: 'number' },
                {data:'carrying_amount', name:'carrying_amount'}
            ]
        });
    });
</script>