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

    /** Course add & edit **/
    $('.js_course_add_modal_form').on('submit', function(e) {
        e.preventDefault()

        let url = $(this).attr('action')
        let method = $(this).attr('method')
        let name_error = $(this).find('.name_error')
        let price_error = $(this).find('.price_error')
        let month_error = $(this).find('.month_error')

        $.ajax({
            url: url,
            type: method,
            dataType: "json",
            data: $(this).serialize(),
            success: (response) => {

                if (response.success == false) {
                    if (response.errors.name) {
                        name_error.removeClass('valid-feedback')
                        name_error.siblings('input[name="name"]').addClass('is-invalid')
                    }
                    if (response.errors.price) {
                        price_error.removeClass('valid-feedback')
                        price_error.siblings('input[name="price"]').addClass('is-invalid')
                    }
                    if (response.errors.month) {
                        month_error.removeClass('valid-feedback')
                        month_error.siblings('select[name="month"]').addClass('is-invalid')
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


    $('.js_course_add_modal_form input[name="name"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.name_error').addClass('valid-feedback')
    })

    $('.js_course_add_modal_form input[name="price"]').on('keyup', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.price_error').addClass('valid-feedback')
    })

    $('.js_course_add_modal_form select[name="month"]').on('change', function () {
        $(this).removeClass('is-invalid')
        $(this).siblings('.month_error').addClass('valid-feedback')
    })

});
