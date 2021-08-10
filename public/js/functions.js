$(document).ready(function () {


    // $.mask.definitions['~'] = "[+-]";
    $("#phone").mask("(99) 999 99-99");
    $("#phone2").mask("(99) 999 99-99");
    $(".phone-student").mask("(99) 999 99-99");



    /** =================================  TEACHERS  ================================== **/

    /** Teacher add & edit **/
    $('.js_modal_teacher_form').on('submit', function(e) {
        e.preventDefault()

        let url = $(this).attr('action')
        let method = $(this).attr('method')
        let firstname_error = $(this).find('.firstname_error')
        let lastname_error  = $(this).find('.lastname_error')
        let phone_error     = $(this).find('.phone_error')
        let address_error   = $(this).find('.address_error')
        let born_error      = $(this).find('.born_error')
        let company_error   = $(this).find('.company_error')
        let username_error  = $(this).find('.username_error')
        let password_error  = $(this).find('.password_error')
        let password_confirm_error = $(this).find('.password_confirm_error')

        let course_error = $(this).find('.course_error')
        $.ajax({
            url: url,
            type: method,
            dataType: "json",
            data: $(this).serialize(),
            success: (response) => {
                console.log(response)
                if (response.success == false) {
                    if (response.errors.firstname) {
                        firstname_error.removeClass('valid-feedback')
                        firstname_error.siblings('input[name="firstname"]').addClass('is-invalid')
                    }
                    if (response.errors.lastname) {
                        lastname_error.removeClass('valid-feedback')
                        lastname_error.siblings('input[name="lastname"]').addClass('is-invalid')
                    }
                    if (response.errors.phone) {
                        phone_error.removeClass('valid-feedback')
                        phone_error.siblings('input[name="phone"]').addClass('is-invalid')
                    }
                    if (response.errors.address) {
                        address_error.removeClass('valid-feedback')
                        address_error.siblings('input[name="address"]').addClass('is-invalid')
                    }
                    if (response.errors.born) {
                        born_error.removeClass('valid-feedback')
                        born_error.siblings('input[name="born"]').addClass('is-invalid')
                    }

                    if (response.errors.company) {
                        company_error.removeClass('valid-feedback')
                        company_error.siblings('input[name="company"]').addClass('is-invalid')
                    }
                    if (response.errors.username) {
                        username_error.removeClass('valid-feedback')
                        username_error.siblings('input[name="username"]').addClass('is-invalid')
                    }

                    if (response.errors.password) {
                        password_error.removeClass('valid-feedback')
                        password_error.siblings('input[name="password"]').addClass('is-invalid')
                    }
                    if (response.errors.password_confirm) {
                        password_confirm_error.removeClass('valid-feedback')
                        password_confirm_error.siblings('input[name="password_confirm"]').addClass('is-invalid')
                    }

                    if (response.errors.course) {
                        course_error.removeClass('valid-feedback')
                    }

                }
                if (response.success) {
                    location.reload()
                }
            },
            error: (response) => {
                console.log(response)
            }
        });

    });

    $('.js_modal_teacher_form input[name="firstname"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.firstname_error').addClass('valid-feedback')
    })

    $('.js_modal_teacher_form input[name="lastname"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.lastname_error').addClass('valid-feedback')
    })

    $('.js_modal_teacher_form input[name="phone"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.phone_error').addClass('valid-feedback')
    })

    $('.js_modal_teacher_form input[name="address"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.address_error').addClass('valid-feedback')
    })

    $('.js_modal_teacher_form input[name="born"]').on('change', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.born_error').addClass('valid-feedback')
    })

    $('.js_modal_teacher_form input[name="company"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.company_error').addClass('valid-feedback')
    })

    $('.js_modal_teacher_form input[name="username"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.username_error').addClass('valid-feedback')
    })

    $('.js_modal_teacher_form input[name="password"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.password_error').addClass('valid-feedback')
    })

    $('.js_modal_teacher_form input[name="password_confirm"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.password_confirm_error').addClass('valid-feedback')
    })

    /** ================================= ./TEACHERS  ================================== **/



    /** ================================= ./GROUPS  ================================== **/

    $('#datatableGroup').DataTable({
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

    /** Group add & edit **/
    $('.js_modal_group_form').on('submit', function(e) {
        e.preventDefault()

        let url     = $(this).attr('action')
        let method  = $(this).attr('method')
        let course_id_error = $(this).find('.course_id_error')
        let teacher_id_error= $(this).find('.teacher_id_error')
        let name_error      = $(this).find('.name_error')
        let time_error      = $(this).find('.time_error')
        let type_error      = $(this).find('.type_error')

        let days_error      = $(this).find('.days_error')

        $.ajax({
            url: url,
            type: method,
            dataType: "json",
            data: $(this).serialize(),
            success: (response) => {
                console.log(response)
                if (response.success == false) {
                    if (response.errors.course_id) {
                        course_id_error.removeClass('valid-feedback')
                        course_id_error.siblings('select[name="course_id"]').addClass('is-invalid')
                    }
                    if (response.errors.teacher_id) {
                        teacher_id_error.removeClass('valid-feedback')
                        teacher_id_error.siblings('select[name="teacher_id"]').addClass('is-invalid')
                    }
                    if (response.errors.name) {
                        name_error.removeClass('valid-feedback')
                        name_error.siblings('input[name="name"]').addClass('is-invalid')
                    }
                    if (response.errors.address) {
                        address_error.removeClass('valid-feedback')
                        address_error.siblings('input[name="address"]').addClass('is-invalid')
                    }
                    if (response.errors.time) {
                        time_error.removeClass('valid-feedback')
                        time_error.siblings('input[name="time"]').addClass('is-invalid')
                    }

                    if (response.errors.type) {
                        type_error.removeClass('valid-feedback')
                        type_error.siblings('select[name="type"]').addClass('is-invalid')
                    }


                    if (response.errors.days) {
                        days_error.removeClass('valid-feedback')
                    }

                }
                if (response.success) {
                    location.reload()
                }
            },
            error: (response) => {
                console.log(response)
            }
        });

    });

    $('.js_modal_group_form select[name="course_id"]').on('change', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.course_id_error').addClass('valid-feedback')
    })

    $('.js_modal_group_form select[name="teacher_id"]').on('change', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.teacher_id_error').addClass('valid-feedback')
    })

    $('.js_modal_group_form input[name="name"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.name_error').addClass('valid-feedback')
    })

    $('.js_modal_group_form input[name="time"]').on('change', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.time_error').addClass('valid-feedback')
    })

    $('.students_ingroup').multiSelect({
        afterSelect: (values) => {
            alert("Guruhga qo'shishni tasdiqlaysizmi")
        },
        afterDeselect: (values) => {
            alert("Guruhdan chiqarishni tasdiqlaysizmi")
        }
    })

    /** ================================= ./GROUPS  ================================== **/


    /** =================================  Expense  ================================== **/

    $('#datatableExpense').DataTable({
        paging: true,
        pageLength: 10,
        lengthChange: false,
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

    /** Expense add & edit **/
    $('.js_expense_modal_form').on('submit', function(e) {
        e.preventDefault()

        let url     = $(this).attr('action')
        let method  = $(this).attr('method')
        let name_error  = $(this).find('.name_error')
        let money_error = $(this).find('.money_error')
        let cost_id_error = $(this).find('.cost_id_error')

        $.ajax({
            url: url,
            type: method,
            dataType: "json",
            data: $(this).serialize(),
            success: (response) => {
                console.log(response)
                if (response.success == false) {

                    if (response.errors.name) {
                        name_error.removeClass('valid-feedback')
                        name_error.siblings('input[name="name"]').addClass('is-invalid')
                    }
                    if (response.errors.money) {
                        money_error.removeClass('valid-feedback')
                        money_error.siblings('input[name="money"]').addClass('is-invalid')
                    }
                    if (response.errors.cost_id) {
                        cost_id_error.removeClass('valid-feedback')
                        cost_id_error.siblings('select[name="cost_id"]').addClass('is-invalid')
                    }

                }
                if (response.success) {
                    location.reload()
                }
            },
            error: (response) => {
                console.log(response)
            }
        });

    });

    $('.js_expense_modal_form input[name="name"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.name_error').addClass('valid-feedback')
    })

    $('.js_expense_modal_form input[name="money"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.money_error').addClass('valid-feedback')
    })

    $('.js_expense_modal_form select[name="cost_id"]').on('change', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.cost_id_error').addClass('valid-feedback')
    })

});
