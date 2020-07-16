"use strict";
var KTDatatablesBasicBasic = {
    init: function() {
        var e;
        (e = $("#kt_table_1")).DataTable({
            responsive: !0,
            paging: false,
            dom:
                "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            buttons: [
                "print",
                "copyHtml5",
                "excelHtml5",
                "csvHtml5",
                "pdfHtml5"
            ],
            pageLength: 100,
            language: { lengthMenu: "Display _MENU_" }
        });
    }
};
jQuery(document).ready(function() {
    KTDatatablesBasicBasic.init();
});
