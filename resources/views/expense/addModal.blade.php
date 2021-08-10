<div class="modal fade" id="add-model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-model-Lavel">{{ 'Chiqm qo\'shish' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('expense.store') }}" class="js_expense_modal_form form-group">
                @csrf
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name">Nomi</label>
                            <input type="text" name="name" id="name" class="form-control" >
                            <div class="valid-feedback text-danger name_error">Ma'lumotni kiriting!</div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="money">Narxi</label>
                            <input type="number" class="form-control" name="money" id="money" >
                            <div class="valid-feedback text-danger money_error">Narxni kiriting!</div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="cost_id">Harajat turi</label>
                                <select name="cost_id" class="form-control" id="cost_id">
                                    <option value="">---</option>
                                    @foreach($costs as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback text-danger cost_id_error">Harajat turini tanlang!</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-3 pb-0">
                    <input type="submit" value="Saqlash" class="js_add_modal_btn_save btn btn-success btn-square">
                    <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Bekor qilish</button>
                </div>
            </form>
        </div>
    </div>
</div>
