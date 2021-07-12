{{-- catalog  --}}
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
                <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Yo'q</button>
                <form id="js_modal_delete_form" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input type="submit" value="Xa" class="btn btn-danger btn-square">
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Mahsulot qolmaganda --}}
<div class="modal fade" id="warn_model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content bg-warning">
            <div class="modal-body pl-0 pr-0 pb-2">
                <h4 class="align-items-center text-center">
                    Boshqa mahsulot mavjud emas.
                </h4>
            </div>
        </div>
    </div>
</div>



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
