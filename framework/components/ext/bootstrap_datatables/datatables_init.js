$(document).ready(function() {
    $('#log').dataTable( {
        "order": [[ 0, "desc" ]],
        "searching":   false,
        "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Alle"]],
        "language": {
            "lengthMenu": "Zeige _MENU_ Einträge pro Seite",
            "zeroRecords": "Nichts gefunden",
            "info": "Zeige Seite _PAGE_ von _PAGES_",
            "infoEmpty": "Keine Einträge",
            "infoFiltered": "(gefiltert aus insgesamt _MAX_ Einträgen)",
            "search": "Suche"
        }
    } );
} );