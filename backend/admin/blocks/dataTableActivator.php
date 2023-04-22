<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
            "buttons": [
                {
                    extend: 'collection',
                    text: 'Eksportēt',
                    buttons: [
                        { extend: 'copy', text: 'Kopēt starpliktuvē' },
                        { extend: 'csv', text: 'CSV formātā' },
                        { extend: 'excel', text: 'Excel formātā' },
                        { extend: 'pdf', text: 'PDF formātā' },
                        { extend: 'print', text: 'Drukāt' },
                    ]
                },
                { extend: 'colvis', text: 'Kolonnu redzamība' }
            ],
            "language": {
                "decimal":        "",
                "emptyTable":     "Tabulā nav datu",
                "info":           "Parādīts no _START_. līdz _END_. no kopā _TOTAL_ ierakstiem",
                "infoEmpty":      "Parādīts no 0. līdz 0. no kopā 0 ierakstiem",
                "infoFiltered":   "(atlasīti no _MAX_ ierakstiem kopā)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Rādīt _MENU_ ierakstus lapā",
                "loadingRecords": "Ielādē...",
                "processing":     "",
                "search":         "Meklēt:",
                "zeroRecords":    "Netika atrasts neviens ieraksts",
                "paginate": {
                    "first":      "|<",
                    "last":       ">|",
                    "next":       ">",
                    "previous":   "<"
                },
                "aria": {
                    "sortAscending":  ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            }
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>