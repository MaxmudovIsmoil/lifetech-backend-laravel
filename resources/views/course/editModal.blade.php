<div class="modal fade" id="edit{{ $cor->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit-model-Lavel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-model-Lavel">{{ 'Kurs Tahrirlash' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('course.update',[ $cor->id ]) }}" class="js_course_add_modal_form form-group">
                @csrf
                {{ method_field('PUT') }}

                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name{{ $cor->id }}">Nomi</label>
                            <input type="text" name="name" id="name{{ $cor->id }}" class="form-control" value="{{ $cor->name }}">
                            <div class="valid-feedback text-danger name_error">
                                Ma'lumotni kiriting !
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="price{{ $cor->id }}">Narxi</label>
                            <input type="number" class="form-control" name="price" id="price{{ $cor->id }}" value="{{ $cor->price }}">
                            <div class="valid-feedback text-danger price_error">
                                Narxni kiriting !
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label for="month{{ $cor->id }}">Muddati</label>
                                <select name="month" class="form-control" id="month{{ $cor->id }}">
                                    <option value="">---</option>
                                    <option @if($cor->month == 1) selected @endif value="1">1 Oy</option>
                                    <option @if($cor->month == 2) selected @endif value="2">2 Oy</option>
                                    <option @if($cor->month == 3) selected @endif value="3">3 Oy</option>
                                    <option @if($cor->month == 4) selected @endif value="4">4 Oy</option>
                                    <option @if($cor->month == 5) selected @endif value="5">5 Oy</option>
                                    <option @if($cor->month == 6) selected @endif value="6">6 Oy</option>
                                    <option @if($cor->month == 7) selected @endif value="7">7 Oy</option>
                                    <option @if($cor->month == 8) selected @endif value="8">8 Oy</option>
                                    <option @if($cor->month == 9) selected @endif value="9">9 Oy</option>
                                    <option @if($cor->month == 10) selected @endif value="10">10 Oy</option>
                                </select>
                                <div class="valid-feedback text-danger month_error">
                                    Mudatni tanlang!
                                </div>
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
