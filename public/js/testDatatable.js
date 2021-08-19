/***********
 * Chiqimlar uchun datatable yaratish
 * */
function create_datatable_cash() {
    var url = $(document).find(".js_show_cash_expenses").data("url");//ajax_student_payments_datatable
    table = $('#js_datatable_cash').DataTable();
    table.destroy();

    return table = $('#js_datatable_cash').DataTable({
        "scrollY": "300px",
        "scrollCollapse": true,
        "paging": false,
        "bFilter": false,
        "searching": true,
        "ordering": true,
        "order":[[ 0, "desc" ]],
        "info":     false,
        "autoWidth": true,
        // "lengthMenu": [[10], [10]]
        "language": {
            "emptyTable": "Маълумотлар топилмади",
            "sInfoEmpty":"Umumiy 0 yozuvlardan 0 dan 0 gachasi ko'rsatilmoqda",
            "oPaginate": {
                "sFirst":       "Биринчи",
                "sPrevious":    "Аввалги",
                "sNext":        "Кейинги",
                "sLast":        "Сўнгги"
            },
            "sSearch":          "Қидириш:",
        },
        columnDefs: [
            { "orderable": false, targets: 0 },
            { "width": "50%", "targets": 0 },
            { "width": "50", "targets": 1 },
            // { "width": "15%", "targets": 2 },
            // { "width": "15%", "targets": 3 },
            // { "width": "27%", "targets": 4 },
            // { "width": "8%", "targets": 5 },
        ],
        "ajax": {
            "url": url,
            "type": "GET",
            "success": function (res) {
              console.log(res);
            }
        },
    });
}


$('.js_show_cash_expenses').on('click', function (e) {
    e.preventDefault()

    // console.log('salom dunyo')

    create_datatable_cash();

    $('#js_data_modal_test').modal('show')

})


