
$(document).ready(function () {

    $("#phone").mask("(99) 999 99-99");
    $("#phone2").mask("(99) 999 99-99");
    $(".phone-student").mask("(99) 999 99-99");

    $('#datatableTeacher').DataTable({
        paging: false,
        pageLength: 20,
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

    /** Teacher add **/
    $('#js_modal_add_teacher_form').on( 'submit',  function(e) {
        e.preventDefault();
        let url = $(this).attr('action');

        // console.log($(this).serialize())
        let formData = new FormData(this);

        $.ajax({
            url: url,
            type: 'POST',
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {

                if(response.status == 0){
                    $.each(response.error,function (prefix, val) {

                        if (val == 'The username has already been taken.') {
                            $('.username-error').addClass('d-block')
                            $('.username-error').html('Bunday login mavjud iltimos boshqa kiriting.')
                        }

                        if (val == 'The password must be at least 6 characters.') {
                            $('.password-error').addClass('d-block')
                            $('.password-error').html('Parol kamida 6 xonali belgidan iborat bo\'lishi kerak.')
                        }

                        if (val == 'The password confirmation does not match.') {
                            $('.password-confirm-error').addClass('d-block')
                            $('.password-confirm-error').html('Parolni tasdiqlash mos emas.')
                        }
                        console.log(prefix+": "+val);
                    })
                }
                if(response.status == 1)
                    location.reload();

            },
            error: (response) => {
                console.log(response)
            }
        });
    })


    /** Teacher edit **/
    $('.js_modal_edit_teacher_form').on( 'submit',  function(e) {
        e.preventDefault();
        let url = $(this).attr('action');
        let formData = new FormData(this);

        $.ajax({
            url: url,
            type: 'POST',
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {

                $.each(response.error,function (prefix, val) {

                    if (val == "The password must be at least 6 characters.") {
                        $('.password-error').addClass('d-block')
                        $('.password-error').html('Parol kamida 6 xonali belgidan iborat bo\'lishi kerak.')
                    }

                    if (val == 'The password confirm and password must match.') {
                        $('.password-confirm-error').addClass('d-block')
                        $('.password-confirm-error').html('Parolni tasdiqlash mos emas.')
                    }
                    // console.log(prefix+": "+val);
                })

                if(response.status == 'success')
                    location.reload();

            },
            error: (response) => {
                console.log(response)
            }
        });
    })

});
