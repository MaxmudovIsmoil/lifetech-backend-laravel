{{-- Delete Modal  --}}
<div class="modal fade" id="delete_notify" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="delete-model-title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-model-title">O'chirish oynasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <p style="background: #f8d7da; color: darkred; padding: 5px 7px; border-radius: 5px;line-height: 1.5;">
                    Barcha ma'lumotlar qayta tiklanmaydigan bo'lib o'chadi. Siz rosdan ham o'chirmoqchimisiz ?
                </p>
            </div>
            <div class="modal-footer">
                <form id="js_modal_delete_form" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" value="Xa" class="btn btn-danger btn-square">
                </form>
                <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Yo'q</button>
            </div>
        </div>
    </div>
</div>


{{-- Student payment delete modal --}}
<div class="modal fade" id="payment_delete_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="delete-model-title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-sm" style="background: #ffe7e9;">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-model-title">To'lovni o'chirish</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <p style="background: #f8d7da; color: darkred; padding: 5px 7px; margin-bottom: 0px; border-radius: 5px;line-height: 1.5;">
                    Siz rosdan ham o'chirmoqchimisiz ?
                </p>
            </div>
            <div class="modal-footer">
                <form id="js_student_payment_delete_modal_form" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" value="Xa" class="btn btn-danger btn-sm">
                </form>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Yo'q</button>
            </div>
        </div>
    </div>
</div>



{{-- Guruhga student qo'shishda tasdiqlash oynasi --}}
<div class="modal fade" id="student_in_group_model" data-keyboard="false" tabindex="-1" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content bg-success">
            <div class="modal-body pl-0 pb-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="align-items-center text-center">
                    O'quvchi guruhga qo'shildi.
                    Tasdiqlash uchun saqlash tugmasini bosing
                </h4>
            </div>
        </div>
    </div>
</div>

{{-- Guruhdan studentni chiqarishda tasdiqlash oynasi --}}
<div class="modal fade" id="student_out_group_model" data-keyboard="false" tabindex="-1" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content bg-warning">
            <div class="modal-body pl-0 pb-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="align-items-center text-center">
                    O'quvchi guruhdan chiqarildi.
                    Tasdiqlash uchun saqlash tugmasini bosing
                </h4>
            </div>
        </div>
    </div>
</div>






{{-- =============================== --}}
<div class="modal fade" id="js_data_modal_test" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="delete-model-title" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-model-title">Test Datatable Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">

                <table class="table table-border table-striped custom-table mb-0 compact expenses_table" id="js_datatable_cash">
                    <thead>
                    <tr>
                        <th>Ким киритди</th>
                        <th>Сумма</th>
{{--                        <th>Тўлов тури</th>--}}
{{--                        <th>Чиқим тури</th>--}}
{{--                        <th>Сабаб</th>--}}
{{--                        <th><div class="fa fa-cog1"></div></th>--}}
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
            <div class="modal-footer">
                <input type="submit" value="Xa" class="btn btn-danger btn-square">
                <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Yo'q</button>
            </div>
        </div>
    </div>
</div>


{{-- =============================== --}}

{{-- user login and password update successful --}}
<div class="modal fade" id="successful_model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content bg-success">
            <div class="modal-body pl-0 pr-0 pb-2">
                <h4 class="align-items-center text-center">
                    Muvaffaqiyatli yangilandi.
                </h4>
            </div>
        </div>
    </div>
</div>
