
/**
 * Student active groups
 * **/
function studentActiveGroups(student_active_groups) {
    let sag = '<option value="">-Tanlang-</option>';
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
              '   <td class="text-center">' + value.total + '</td>\n' +
              '   <td class="text-center">' + value.discount + '</td>\n' +
              '   <td class="text-center">' + payment_detalies[value.id] + '</td>\n' +
              '   <td class="text-center text-danger">' + qarz + '</td>\n' +
              '</tr>';
    });
        sp +='</tbody>';
    return sp;
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
        let payment_table = $(this).siblings('.js_student_payment_table')

        console.log(payment_table)

        let group_id = $(this).val();
        let student_id = $(this).data('student_id');

        console.log(group_id)
        console.log(student_id)

        let pathname = window.location.origin;
        let url = pathname+'/student/student_payments_in_group/'+student_id+'/'+group_id;
        // console.log(pathname)
        $.ajax({
            url: url,
            type: 'GET',
            dataType: "json",
            // data: {},
            success: (response) => {
                console.log(response)
                payment_table.html(StudentPayments(response.student_payments, response.student_payment_detalies_arr))
            },
            error: (response) => {
                console.log(response)
            }
        });
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


    /** Student payment modal form **/
    $('.js_student_payment_in_group_form_modal').on('submit', function(e) {
        e.preventDefault()

        let paid = $(this).find('.paid').val()
        let payment_type = $(this).find('.payment_type').val()
        let discount_type = $(this).find('.discount_type').val()

    });


});
