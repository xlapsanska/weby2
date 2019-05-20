var table = document.getElementsByClassName("myTable");

if(document.documentElement.lang == "sk"){
    if(table.length != 0){
        $(document).ready( function () {
            var table = $('.myTable').DataTable({
                "language": {
                    "lengthMenu": "Zobraz _MENU_ záznamov",
                    "zeroRecords": "Žiadne záznamy",
                    "info": "Zobrazilo sa _PAGE_ stránok z _PAGES_",
                    "infoEmpty": "Žiadne záznamy",
                    "infoFiltered": "(vyfiltrované z _MAX_ záznamov)",
                    "search":         "Hľadať:",
                    "paginate": {
                        "first":      "Prvý",
                        "last":       "Posledný",
                        "next":       "Ďalej",
                        "previous":   "Späť"
                    },
                }
            });
            var tableTools = new $.fn.dataTable.TableTools( table );

            // table.buttons().container()
            // .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
        
            } );
    }
}
else if(document.documentElement.lang == "en"){
    if(table.length != 0){
        $(document).ready( function () {
            var table = $('.myTable').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "Nothing found - sorry",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "search":         "Search:",
                    "paginate": {
                        "first":      "First",
                        "last":       "Last",
                        "next":       "Next",
                        "previous":   "Previous"
                    },
                }
            });

            var tableTools = new $.fn.dataTable.TableTools( table );
            // table.buttons().container()
            // .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
        
            } );
    }
}





 


