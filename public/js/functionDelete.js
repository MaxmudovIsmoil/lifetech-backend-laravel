

$(document).on("click", ".js_delete_btn", function () {

    let name = $(this).data('name')
    let url = $(this).data('url')


    let title = $(document).find('#delete-model-title')
    let modalForm = $(document).find('#js_modal_delete_form')

    title.text(name);
    modalForm.attr('action', url)

});


let delete_form = $(document).find('#js_modal_delete_form')
delete_form.on('submit', function (e) {
    e.preventDefault()

    let url = $(this).attr('action')
    let this_tr = $(document).find('.js_this_tr')

    $.ajax({
        type:"POST",
        url: url,
        data: $(this).serialize(),
        success: (response) => {

            console.log(response);

            this_tr.each(function (item, arr) {
                if($(arr).data('id') == response.id)
                    arr.remove()
            })

            $(this).closest('#delete_notify').modal('hide')
        },
        error: (response) => {
            console.log(response);
        }
    });

})
/** ================================================================================== **/
