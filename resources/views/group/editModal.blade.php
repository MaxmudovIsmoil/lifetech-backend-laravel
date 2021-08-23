<div class="modal fade" id="edit{{ $g['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit-model-Lavel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-model-Lavel">{{ 'Kurs Tahrirlash' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('group.update', [$g['id']]) }}" class="js_modal_group_form form-group">
                @csrf
                {{ method_field('PUT') }}
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="course_id{{ $g['id'] }}">Kurs</label>
                                <select name="course_id" class="form-control" id="course_id{{ $g['id'] }}" >
                                    <option value="">---</option>
                                    @foreach($course as $c)
                                        <option value="{{ $c->id }}" @if($c->id == $g['course_id']) selected @endif>{{ $c->name }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback text-danger course_id_error">Kursni tanlang !</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="teacher_id{{ $g['id'] }}">O'qituvchi</label>
                                <select name="teacher_id" class="form-control" id="teacher_id{{ $g['id'] }}" >
                                    <option value="">---</option>
                                    @foreach($teachers as $t)
                                        <option value="{{ $t->id }}" @if($t->id == $g['teacher_id']) selected @endif>{{ $t->lastname." ".$t->firstname }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback text-danger teacher_id_error">O'qituvchini tanlang !</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <labal for="monday{{ $g['id'] }}">Kunlari</labal>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="monday" id="monday{{ $g['id'] }}" value="1" @if($g['days'][0]) checked @endif>
                                <label class="form-check-label" for="monday{{ $g['id'] }}">Dushanba</label>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="tuesday" id="tuesday{{ $g['id'] }}" value="1" @if($g['days'][1]) checked @endif>
                                <label class="form-check-label" for="tuesday{{ $g['id'] }}">Seshanba</label>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="wednesday" id="wednesday{{ $g['id'] }}" value="1" @if($g['days'][2]) checked @endif>
                                <label class="form-check-label" for="wednesday{{ $g['id'] }}">Chorshanba</label>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="thursday" id="thursday{{ $g['id'] }}" value="1" @if($g['days'][3]) checked @endif>
                                <label class="form-check-label" for="thursday{{ $g['id'] }}">Payshanba</label>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="friday" id="friday{{ $g['id'] }}" value="1" @if($g['days'][4]) checked @endif>
                                <label class="form-check-label" for="friday{{ $g['id'] }}">Juma</label>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="saturday" id="saturday{{ $g['id'] }}" value="1" @if($g['days'][5]) checked @endif>
                                <label class="form-check-label" for="saturday{{ $g['id'] }}">Shanba</label>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" name="sunday" id="sunday{{ $g['id'] }}" value="1" @if($g['days'][6]) checked @endif>
                                <label class="form-check-label" for="sunday{{ $g['id'] }}">Yakshanba</label>
                            </div>
                            <div class="valid-feedback text-danger mt-2 days_error">Kunlarni tanlang!</div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name{{ $g['id'] }}">Nomi</label>
                                    <input type="text" name="name" id="name{{ $g['id'] }}" class="form-control" value="{{ $g['name'] }}" >
                                    <div class="valid-feedback text-danger name_error">Nomini kiriting !</div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="time{{ $g['id'] }}">Soati</label>
                                    <input type="time" class="form-control" name="time" id="time{{ $g['id'] }}" value="{{ $g['time'] }}" >
                                    <div class="valid-feedback text-danger time_error">Vaqtini kiriting !</div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <label for="type{{ $g['id'] }}">Turi</label>
                                        <select name="type" class="form-control" id="type{{ $g['id'] }}" >
                                            <option value="1" @if($g['type'] == 1) selected @endif>Guruh</option>
                                            <option value="2" @if($g['type'] == 2) selected @endif>Indvidual</option>
                                        </select>
                                    </div>
                                    <div class="valid-feedback text-danger">Guruh turini tanlang !</div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <label for="status{{ $g['id'] }}">Status</label>
                                        <select name="status" class="form-control" id="status{{ $g['id'] }}" >
                                            <option value="1" @if($g['status'] == 1) selected @endif>Ynagi</option>
                                            <option value="2" @if($g['status'] == 2) selected @endif>O'qiyotgan</option>
                                            <option value="3" @if($g['status'] == 3) selected @endif>Bitirgan</option>
                                        </select>
                                    </div>
                                    <div class="valid-feedback text-danger">Guruh maqomini tanlang !</div>
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
