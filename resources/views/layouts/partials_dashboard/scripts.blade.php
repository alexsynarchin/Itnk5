<script src="assets/js/admin.js"></script>
<script>
    $(function() {
        $('#items-table').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json",
                "thousands": ","
            },
            processing: true,
            serverSide: true,
            ajax: '{!! route('datatables.data') !!}',
            columns: [
                {data: 'rownum', name: 'rownum'},
                { data: 'name', name: 'name' },
                { data: 'number', name: 'number' },
                { data: 'os_date', name: 'os_date' },
                {data:'carrying_amount', name:'carrying_amount'}
            ]
        });
    });
</script>