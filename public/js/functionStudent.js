

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
    sp += '';
    let tolovAll = 0
    let chegirmaAll = 0
    let tolanganAll = 0
    let qarzdorlikAll = 0
    let t = false;
    let ch = 0;
    $.each( student_payments, function( key, value ) {
        if (value.month) {
            let q = value.total * 1 - (value.discount * 1 + payment_detalies[value.id] * 1);
            let qarz = value.total * 1 - (value.discount * 1 + payment_detalies[value.id] * 1);
            if (qarz > 0) {
                qarz = "-" + numeral(qarz).format('0,0');
            }
            if (value.discount_type == 0) {
                ch = '<td class="text-center">'+value.discount+'</td>\n'
            }
            else if(value.discount_type == 1) {
                ch = '<td class="text-center">'+numeral(value.discount).format('0,0')+'</td>\n'
            }
            else if(value.discount_type == 2) {
                ch = '<td class="text-center">'+value.discount_val+ '% &nbsp&nbsp ' +numeral(value.discount).format('0,0')+'</td>\n'
            }

            sp += '<tr data-payment_id="'+value.id+'" data-month="'+value.month+'" data-tolov="'+value.total+'" data-tolangan="'+payment_detalies[value.id]+'" data-chegirma="'+value.discount+'" data-qarz="'+q+'">\n' +
                '   <td class="text-center">' + value.month + '</td>\n' +
                '   <td class="text-center">' + formatDate(value.created_at) + '</td>\n' +
                '   <td class="text-center">' + numeral(value.total).format('0,0') + '</td>\n' +
                    ch +
                '   <td class="text-center">' + numeral(payment_detalies[value.id]).format('0,0') + '</td>\n' +
                '   <td class="text-center text-danger js_student_lend" data-td_last_month="'+value.month+'" data-payment_id=' + value.id + '>' + qarz + '</td>\n' +
                '   <td class="text-center" data-payment_id=' + value.id + '>' +
                    '<a href="javascript:void(0);" style="color: darkred" class="js_payment_action_btn" data-payment_id="'+value.id+'" data-toggle="modal" data-target="#delete_student_payment">' +
                        '<svg class="c-icon c-icon-lg">\n' +
                            '<use xlink:href="'+window.location.origin+'/public/icons/sprites/free.svg#cil-trash"></use>\n' +
                        '</svg>' +
                    '</a>' +
                '</td>\n' +
                '</tr>';
            tolovAll += parseInt(value.total)
            tolanganAll += parseInt(payment_detalies[value.id])
            chegirmaAll += parseInt(value.discount)
            qarzdorlikAll += parseInt(value.total * 1 - (value.discount * 1 + payment_detalies[value.id] * 1))
        }
        else {
            sp = '<tr><td colspan="6" class="text-center text-danger">To\'lovlar mavjud emas</td></tr>';
            t = true
        }
    });
    if (!t) {
        sp += '<tr data-month="0">' +
                '<td class="text-center" colspan="2"></td>' +
                '<td class="text-center font-weight-bold">'+numeral(tolovAll).format('0,0')+'</td>' +
                '<td class="text-center font-weight-bold">'+numeral(chegirmaAll).format('0,0')+'</td>' +
                '<td class="text-center font-weight-bold">'+numeral(tolanganAll).format('0,0')+'</td>' +
                '<td class="text-center text-danger font-weight-bold">-'+numeral(qarzdorlikAll).format('0,0')+'</td>' +
                '<td class="text-center font-weight-bold"></td>' +
             '</tr>';
    }

    return sp;
}


/**
 * Student payment this course month
 * **/
function student_payment_month(months)
{
    let month = '<option value="">Oyni tanlang</option>';
    for(var i = 1; i <= months; i++){
        month += '<option value="'+i+'">'+i+' oy</option>';
    }
    return month;
}


$(document).ready(function () {

    $("#phone").mask("(99) 999 99-99");
    $("#phone2").mask("(99) 999 99-99");
    $(".phone-student").mask("(99) 999 99-99");


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
        let payment_table_tbody = $(this).siblings('.div-student-payments').find('.js_student_payment_table_tbody');

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
                    payment_table_tbody.html(StudentPayments(response.student_payments, response.student_payment_detalies_arr))

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

        let student_this_lend = $(document).find('.js_student_lend');
        let lend = student_this_lend.eq(($(this).val())-1)
        let form = $(this).closest('.js_student_payment_in_group_form_modal')

        let modal_body = $(this).closest('.modal-body')

        var table_tbody_tr = modal_body.find('.js_student_payment_table_tbody tr')

        // console.log($(table_tbody_tr).first().data('tolangan'))
        // console.log($(table_tbody_tr).first().data('tolov'))
        // console.log($(table_tbody_tr).first().data('qarz'))
        // console.log($(table_tbody_tr).first().data('month'))

        var paid = modal_body.find('input[name="paid"]')

        var change_val = parseInt($(this).val())
        let t = false
        $.each( table_tbody_tr, function( key, tr ) {

            if (change_val == $(tr).data('month')) {

                var qarz = $(tr).data('qarz')
                paid.attr('max', qarz)
                console.log('qarz: ', qarz)
            }
            else {
                t = true
            }
        })


        form.find('.js_last_payment_id').val(lend.data('payment_id'))
        form.find('.js_last_lend').val(lend.html())
        form.find('.js_td_last_month').val(lend.data('td_last_month'))
        if ( Math.abs(lend.html()) ) {
            form.find('.paid').attr('max', Math.abs(lend.html()))
        }

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

        let modal_body = $(this).closest('.modal-body');
        let table_tr = modal_body.find('.js_student_payment_table tbody tr');
        let last_tr_first_td = modal_body.find('.js_student_payment_table tbody tr').last().find('td').first().html();

        let month = $(this).find('.js_student_payment_month').val();

        $.ajax({
            url: url,
            type: 'POST',
            dataType: "json",
            data: $(this).serialize(),
            success: (response) => {

                if (response.msg) {
                    $(this).siblings('.js_msg').html(response.msg)
                }

                if (response.payment) {
                    location.reload()
                }
            },
            error: (response) => {
                console.log(response)
            }
        });
    });



    /** payment action btn  **/
    $(document).on("click", ".js_payment_action_btn", function () {

        let id = $(this).data('payment_id')

        let url = window.location.origin+'/student/student_payment_delete/'+id
        let form = $(document).find('#js_student_payment_delete_modal_form')

        form.attr('action', url)
    });


    let delete_form = $(document).find('#js_student_payment_delete_modal_form')
    delete_form.on('submit', function (e) {
        e.preventDefault()

        let url = $(this).attr('action')
        let table_body_tr = $(document).find('.js_student_payment_table_tbody tr')
        let table_body_tr_last = $(document).find('.js_student_payment_table_tbody tr').last()

        $.ajax({
            type: "POST",
            url: url,
            data: $(this).serialize(),
            success: (response) => {

                console.log(response)

                table_body_tr.each(function (item, this_tr) {


                    if($(this_tr).data('payment_id') == response.payment_id) {

                        let tolov    = $(this_tr).data('tolov')
                        let tolangan = $(this_tr).data('tolangan')
                        let chegirma = $(this_tr).data('chegirma')
                        let qarz     = $(this_tr).data('qarz')

                        // console.log('tolov: ', tolov)
                        // console.log('tolangan: ', tolangan)
                        // console.log('chegirma: ', chegirma)
                        // console.log('qarz: ', qarz)

                        let tolovAll = $(table_body_tr_last).find('td').eq(1).html()
                        let chegirmaAll = $(table_body_tr_last).find('td').eq(2).html()
                        let tolanganAll = $(table_body_tr_last).find('td').eq(3).html()
                        let qarzAll = $(table_body_tr_last).find('td').eq(4).html()

                        let tolovAllArray = tolovAll.split(",");
                        let tolovAllstr = ''
                        for (var i = 0; i < tolovAllArray.length; i++) {
                            tolovAllstr += tolovAllArray[i]
                        }

                        let chegirmaAllArray = chegirmaAll.split(",");
                        let chegirmaAllstr = ''
                        for (var i = 0; i < chegirmaAllArray.length; i++) {
                            chegirmaAllstr += chegirmaAllArray[i]
                        }

                        let tolanganAllArray = tolanganAll.split(",");
                        let tolanganAllstr = ''
                        for (var i = 0; i < tolanganAllArray.length; i++) {
                            tolanganAllstr += tolanganAllArray[i]
                        }

                        let qarzAllArray = qarzAll.split(",");
                        let qarzAllstr = ''
                        for (var i = 0; i < qarzAllArray.length; i++) {
                            qarzAllstr += qarzAllArray[i]
                        }

                        let tolovAllNew = parseInt(tolovAllstr)-tolov
                        let chegirmaAllNew = parseInt(chegirmaAllstr)-chegirma
                        let tolanganAllNew = parseInt(tolanganAllstr)-tolangan
                        let qarzAllNew = parseInt(Math.abs(qarzAllstr))-qarz

                        $(table_body_tr_last).find('td').eq(1).html(numeral(tolovAllNew).format('0,0'))
                        $(table_body_tr_last).find('td').eq(2).html(numeral(chegirmaAllNew).format('0,0'))
                        $(table_body_tr_last).find('td').eq(3).html(numeral(tolanganAllNew).format('0,0'))
                        $(table_body_tr_last).find('td').eq(4).html('-'+numeral(qarzAllNew).format('0,0'))

                        this_tr.remove()
                    }
                })

                $(this).closest('#delete_student_payment').modal('hide')
            },
            error: (response) => {
                console.log(response);
            }
        });

    })
    /** ================================================================================== **/





    /** ================================= STUDENTS MODAl VALIDATE  ================================== **/
    var edit_status = $('#edit_status option:checked').val()
    if (edit_status == 0) {
        $("#edit_cause_div").removeClass('d-none')
    }
    $('#editModal #edit_status').change( function () {
        var val = $(this).val()
        if (val == 0)
            $("#edit_cause_div").removeClass('d-none')
        else
            $("#edit_cause_div").addClass('d-none')
    })

    /** Student add modal close inputs in clear **/
    $('#addModal button[data-dismiss="modal"]').click(function () {
        $("#addModal").find('#firstname').val('')
        $('#addModal').find('#lastname').val('')
        $("#addModal").find('#phone').val('')
        $("#addModal").find('#phone2').val('')
        $('#addModal').find('#address').val('')
        $("#addModal").find('#born').val('')
        $("#addModal").find('#company').val('')
    })

    /** Student edit modal close inputs in clear **/
    $('#editModal button[data-dismiss="modal"]').click(function () {

        $("#editModal").find('.course_inputs').removeAttr('checked')

        var firstname = $("#editModal").find('#edit_firstname')
        firstname.val('')
        firstname.removeClass('is-invalid')
        firstname.siblings('.firstname_error').addClass('valid-feedback')

        var lastname = $('#editModal').find('#edit_lastname')
        lastname.val('')
        lastname.removeClass('is-invalid')
        lastname.siblings('.lastname_error').addClass('valid-feedback')

        var phone = $("#editModal").find('#edit_phone')
        phone.val('')
        phone.removeClass('is-invalid')
        phone.siblings('.phone_error').addClass('valid-feedback')

        var phone2 = $("#editModal").find('#edit_phone2')
        phone2.val('')
        phone2.removeClass('is-invalid')
        phone2.siblings('.phone2_error').addClass('valid-feedback')

        var address = $('#editModal').find('#edit_address')
        address.val('')
        address.removeClass('is-invalid')
        address.siblings('.address_error').addClass('valid-feedback')

        var born = $("#editModal").find('#edit_born')
        born.val('')
        born.removeClass('is-invalid')
        born.siblings('.born_error').addClass('valid-feedback')

        var company = $("#editModal").find('#edit_company')
        company.val('')
        company.removeClass('is-invalid')
        company.siblings('.company_error').addClass('valid-feedback')

        var status = $('#editModal').find('#edit_status').val()
        if (status !== 0) {
            $("#edit_cause_div").removeClass('d-none')
        }
    })

    $('.js_modal_student_form input[name="firstname"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.firstname_error').addClass('valid-feedback')
    })

    $('.js_modal_student_form input[name="lastname"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.lastname_error').addClass('valid-feedback')
    })

    $('.js_modal_student_form input[name="phone"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.phone_error').addClass('valid-feedback')
    })

    $('.js_modal_student_form input[name="address"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.address_error').addClass('valid-feedback')
    })

    $('.js_modal_student_form input[name="born"]').on('change', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.born_error').addClass('valid-feedback')
    })

    $('.js_modal_student_form input[name="company"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.company_error').addClass('valid-feedback')
    })

    $('.js_modal_student_form select[name="advertising"]').on('change', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.advertising_error').addClass('valid-feedback')
    })

    $('.js_modal_student_form select[name="status"]').on('change', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.status_error').addClass('valid-feedback')
    })

    /** ================================= ./STUDENTS VALIDATE  ================================== **/

})

