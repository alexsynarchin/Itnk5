<script src="assets/js/admin.js"></script>
<script>
    $(function() {
        $('#items-table').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.10/i18n/Russian.json"
            },
            processing: true,
            serverSide: true,
            ajax: '{!! route('datatables.data') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' }
            ]
        });
    });
</script>