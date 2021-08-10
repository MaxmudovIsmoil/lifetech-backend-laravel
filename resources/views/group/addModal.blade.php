<div class="modal fade" id="add-model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-model-Lavel">{{ 'Guruh qo\'shish' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('group.store') }}" class="js_modal_group_form form-group">
                @csrf
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="course_id">Kurs</label>
                                <select name="course_id" class="form-control" id="course_id">
                                    <option value="">---</option>
                                    @foreach($course as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback text-danger course_id_error">Kursni tanlang !</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="teacher_id">O'qituvchi</label>
                                <select name="teacher_id" class="form-control" id="teacher_id">
                                    <option value="">---</option>
                                    @foreach($teachers as $t)
                                        <option value="{{ $t->id }}">{{ $t->lastname." ".$t->firstname }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback text-danger teacher_id_error">O'qituvchini tanlang !</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <labal for="monday">Kunlari</labal>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="monday" id="monday" value="1">
                                <label class="form-check-label" for="monday">Dushanba</label>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="tuesday" id="tuesday" value="1">
                                <label class="form-check-label" for="tuesday">Seshanba</label>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="wednesday" id="wednesday" value="1">
                                <label class="form-check-label" for="wednesday">Chorshanba</label>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="thursday" id="thursday" value="1">
                                <label class="form-check-label" for="thursday">Payshanba</label>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="friday" id="friday" value="1">
                                <label class="form-check-label" for="friday">Juma</label>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="saturday" id="saturday" value="1">
                                <label class="form-check-label" for="saturday">Shanba</label>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="sunday" id="sunday" value="1">
                                <label class="form-check-label" for="sunday">Yakshanba</label>
                            </div>
                            <div class="valid-feedback text-danger mt-2 days_error">Kunlarni tanlang!</div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">Nomi</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                    <div class="valid-feedback text-danger name_error">Nomini kiriting !</div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="time">Soati</label>
                                    <input type="time" class="form-control" name="time" id="time">
                                    <div class="valid-feedback text-danger time_error">Vaqtini kiriting !</div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="form-group">
                                        <label for="month">Turi</label>
                                        <select name="type" class="form-control" id="type">
                                            <option value="1">Guruh</option>
                                            <option value="2">Indvidual</option>
                                        </select>
                                    </div>
                                    <div class="valid-feedback text-danger type_error">Narxni kiriting !</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-3 pb-0">
                    <input type="submit" value="Saqlash" class="btn btn-success btn-square">
                    <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Bekor qilish</button>
                </div>
            </form>
        </div>
    </div>
</div>
