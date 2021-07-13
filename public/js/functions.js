
function formatDate(date) {
    var d = new Date(date),
        minutes = '' + d.getMinutes(),
        hours = '' + d.getHours(),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (minutes.length < 2)
        minutes = '0'+minutes
    if (hours.length < 2)
        hours = '0'+hours
    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [day, month, year].join('.')+" "+hours+" : "+minutes;
}


/**
 * Student active groups
 * **/
function studentActiveGroups(student_active_groups) {
    let sag = '<option value="0">-Tanlang-</option>';
    $.each(student_active_groups, function (key, value) {
        sag += '<option value="'+value.group_id+'" data-student-id="'+ value.student_id +'">' + value.cname + ", " + value.gname + '</option>';
    })
    return sag;
}


/**
 * Student payments in group
 * **/
function StudentPayments(student_payments, payment_detalies)
{
    let sp = '';
    sp += '<thead>\n' +
          '  <tr>\n' +
          '     <th class="text-center">Oy</th>\n' +
          '     <th class="text-center">Sana</th>\n' +
          '     <th class="text-center">To\'lov</th>\n' +
          '     <th class="text-center">Chegirma</th>\n' +
          '     <th class="text-center">To\'langan</th>\n' +
          '     <th class="text-center">Qarzdorlik</th>\n' +
          '  </tr>\n' +
          '</thead>\n' +
          '<tbody>\n';

    $.each( student_payments, function( key, value ) {

        let qarz  = value.total*1 - (value.discount*1 + payment_detalies[value.id]*1);
        if (qarz > 0) {
            qarz = "-"+qarz;
        }
        sp += '<tr>\n' +
              '   <td class="text-center">' + value.month + '</td>\n' +
              '   <td class="text-center">' + formatDate(value.created_at) + '</td>\n' +
              '   <td class="text-center">' + value.total + '</td>\n' +
              '   <td class="text-center">' + value.discount + '</td>\n' +
              '   <td class="text-center">' + payment_detalies[value.id] + '</td>\n' +
              '   <td class="text-center text-danger js_student_lend" data-payment_id='+value.id+'>' + qarz + '</td>\n' +
              '</tr>';
    });
        sp +='</tbody>';
    return sp;
}

/**
 * Student payment this course month
 * **/
function student_payment_month(months)
{
    let month = '<option value="">-Oyni tanlang-</option>';
    for(var i = 1; i <= months; i++){
        month += '<option value="'+i+'">'+i+' oy</option>';
    }
    return month;
}


/** #################################################################################### **/

$(document).ready(function () {

    $('#datatableCourse').DataTable({
        paging: false,
        pageLength: 20,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: false,
        autoWidth: false,
        language: {
            search: "",
            searchPlaceholder: " Izlash...",
            sLengthMenu: "Кўриш _MENU_ тадан",
            sInfo: "Ko'rish _START_ dan _END_ gacha _TOTAL_ jami",
            emptyTable: "Ma'lumot mavjud emas",
        }
    });

    $('#datatableStudent').DataTable({
        paging: true,
        pageLength: 20,
        lengthChange: false,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        language: {
            search: "",
            searchPlaceholder: " Izlash...",
            sLengthMenu: "Кўриш _MENU_ тадан",
            sInfo: "Ko'rish _START_ dan _END_ gacha _TOTAL_ jami",
            emptyTable: "Ma'lumot mavjud emas",
        }
    });

    // $.mask.definitions['~'] = "[+-]";
    $("#phone").mask("(99) 999 99-99");
    $(".phone-student").mask("(99) 999 99-99");

    $('.students_ingroup').multiSelect()

    /***
     * add Student in group and update
     * **/
    $('.js_add_student_group_modal_from').on( 'submit',  function(e) {
        e.preventDefault()
        let url = $(this).attr('action')
        let formData = new FormData(this);
        // console.log(url)

        let modal = $(this).closest('.modal');

        $.ajax({
            url: url,
            type: 'POST',
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {

                modal.modal('hide')
                console.log(response)

            },
            error: (response) => {
                console.log(response)
            }
        });
    });

    /***
     * Student payments
     * **/
    /** ######################################################################## **/

    /** Student payment btn **/
    $('.js_student_payment_btn').on('click', function(e) {
        // e.preventDefault()

        let this_tr = $(this).closest('.js_this_tr')
        let modal = $(this).siblings('.modal')
        let url = $(this).attr('href');
        let studentActiveGroup = modal.find('.js_student_active_group')

        $.ajax({
            url: url,
            type: 'GET',
            dataType: "json",
            // data: {},
            success: (response) => {
                // console.log(response)
                studentActiveGroup.html(studentActiveGroups(response.student_active_groups))
                studentActiveGroup.attr('data-student_id', response.student_active_groups[0].student_id)
            },
            error: (response) => {
                console.log(response)
            }
        });
    });


    /** student active group on change **/
    $('.js_student_active_group').on('change', function(e) {

        let this_tr = $(this).closest('.js_this_tr')
        let modal = $(this).siblings('.modal')
        let payment_table = $(this).siblings('.div-student-payments').find('.js_student_payment_table');

        let month = $(document).find('.js_student_payment_month');
        let paid = $(document).find('.paid')
        let total = $(document).find('.js_total')

        let group_id = $(this).val();
        let student_id = $(this).data('student_id');


        $(document).find('.js_group_id').val(group_id)

        if (group_id) {

            let pathname = window.location.origin;
            let url = pathname+'/student/student_payments_in_group/'+student_id+'/'+group_id;

            $.ajax({
                url: url,
                type: 'GET',
                dataType: "json",
                // data: {},
                success: (response) => {
                    console.log(response)
                    payment_table.html(StudentPayments(response.student_payments, response.student_payment_detalies_arr))

                    month.html(student_payment_month(response.student_payments[0].cmonth));
                    paid.attr('data-price', response.student_payments[0].cprice)
                    total.val(response.student_payments[0].cprice)
                },
                error: (response) => {
                    console.log(response)
                }
            });
        }
        else{
            payment_table.html();
        }
    });

    /** oy tanlanganda qarzdorligi bor o'tgan oydagilarni payment_id, qarzdorlikni olib formafa hidden tipida qo'shish **/
    $('.js_student_payment_month').on('change', function(){
        console.log($(this).val())
        let student_this_lend = $(document).find('.js_student_lend');
        let lend = student_this_lend.eq(($(this).val())-1)
        let form = $(this).closest('.js_student_payment_in_group_form_modal')
        form.find('.js_last_payment_id').val(lend.data('payment_id'))
        form.find('.js_last_lend').val(lend.html())

        console.log(form)
    });

    /** discount type **/
    $('.discount_type').on('change', function(e) {
        let this_dis_type_val = $(this).val();
        let form = $(this).closest('.js_student_payment_in_group_form_modal');
        let discount_val = form.find('.discount_val');

        if((this_dis_type_val == 1) || (this_dis_type_val == 2))
            discount_val.removeClass('d-none')
        else
            discount_val.addClass('d-none')
    });

    $('.paid').on('keyup', function () {

        let price = $(this).data('price');

        if ($(this).val() > price)
            $(this).css('border', '1px solid red');
        else
            $(this).css('border', '1px solid #d8dbe0');

    })



    /** Student payment modal form **/
    $('.js_student_payment_in_group_form_modal').on('submit', function(e) {
        e.preventDefault()

        let url = $(this).attr('action')

        // let payment_id = $(document).find('.js_student_lend').last().data('payment_id')
        // let lend = $(document).find('.js_student_lend').last().html()
        //
        // $(this).find('.js_last_payment_id').val(payment_id)
        // $(this).find('.js_last_lend').val(lend)


        $.ajax({
            url: url,
            type: 'POST',
            dataType: "json",
            data: $(this).serialize(),
            success: (response) => {
                console.log(response)
            },
            error: (response) => {
                console.log(response)
            }
        });
    });




    // $('.js_student_payment_month').multiselect({
    //     includeSelectAllOption: true,
    //     allSelectedText: 'Barchasi',
    //     nonSelectedText: 'Oyni tanlang',
    //     selectAllText: "Barchasini tanlash",
    //     nSelectedText: " ta tanlash"
    // });

});
