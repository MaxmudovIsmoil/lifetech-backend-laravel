<div class="modal fade" id="edit{{ $s['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit-model-Lavel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-model-Lavel">{{ 'O\'quvchini tahrirlash' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('student.update',[$s['id']]) }}" class="js_modal_student_form form-group">
                @csrf
                {{ method_field('PUT') }}
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="h5">Kurslar</h4>
                            <div class="courses">
                                @foreach($course as $k => $c)
                                    <div class="form-check mt-2">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" @if(in_array($c->id, $s['course_ids'])) checked @endif name="course_{{$c->id}}" value="{{ $c->id }}">
                                            {{ $c->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="valid-feedback text-danger course_error">Kursni tanlng!</div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="firstname{{ $s['id'] }}">Ism</label>
                                    <input type="text" name="firstname" id="firstname{{ $s['id'] }}" class="form-control" value="{{ $s['firstname'] }}" >
                                    <div class="valid-feedback text-danger firstname_error">Ismni kiriting!</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastname{{ $s['id'] }}">Familiya</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname{{ $s['id'] }}" value="{{ $s['lastname'] }}" >
                                    <div class="valid-feedback text-danger lastname_error">Familiyani kiriting!</div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="phone{{ $s['id'] }}">Telefon 1</label>
                                    <input type="text" class="form-control phone-student" name="phone" id="phone{{ $s['id'] }}" value="{{ $s['phone'] }}" >
                                    <div class="valid-feedback text-danger phone_error">Telefon nomerni kiriting!</div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="phone2{{ $s['id'] }}">Telefon 2</label>
                                    <input type="text" class="form-control phone-student" name="phone2" id="phone2{{ $s['id'] }}" value="{{ $s['phone2'] }}">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="address{{ $s['id'] }}">Manzil</label>
                                    <input type="text" class="form-control" name="address" id="address{{ $s['id'] }}" value="{{ $s['address'] }}">
                                    <div class="valid-feedback text-danger address_error">Manzilni kiriting!</div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="born{{ $s['id'] }}">Tug'ulgan sana</label>
                                    <input type="date" class="form-control" name="born" id="born{{ $s['id'] }}" value="{{ $s['born'] }}">
                                    <div class="valid-feedback text-danger born_error">Tug'lgan sanani kiriting!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <label for="gender mt-3 pb-0" style="margin-top: 15px; margin-bottom: 0px;">Jins</label>
                            <span class="mt-0 d-flex justify-content-around">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="gender" @if($s['gender'] == 1) checked @endif value="1" id="gender1{{ $s['id'] }}">
                                    <label class="form-check-label" for="gender1{{ $s['id'] }}">Erkak</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="gender" @if($s['gender'] == 0) checked @endif value="0" id="gender2{{ $s['id'] }}">
                                    <label class="form-check-label" for="gender2{{ $s['id'] }}">Ayol</label>
                                </div>
                            </span>
                        </div>

                        <div class="col-md-4 mt-2">
                            <label for="company{{ $s['id'] }}">Ishxona / O'qish</label>
                            <input type="text" class="form-control" name="company" id="company{{ $s['id'] }}" value="{{ $s['company'] }}">
                            <div class="valid-feedback text-danger company_error">Ma'lumotni kiriting!</div>
                        </div>
                        <div class="col-md-4 mt-2">
                            <div class="form-group">
                                <label for="advertising{{ $s['id'] }}">Reklamani qayerda ko'rdingiz</label>
                                <select name="advertising" class="form-control" id="advertising{{ $s['id'] }}" >
                                    <option value="">---</option>
                                    @foreach($advertising as $ad)
                                        <option @if($ad->name == $s['advertising']) selected @endif >{{ $ad->name }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback text-danger advertising_error">Tnalang!</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="status{{ $s['id'] }}">Maqomi</label>
                            <select class="form-control" id="status{{ $s['id'] }}" name="status">
                                <option>---</option>
                                <option value="1" @if($s['status'] == 1) selected @endif>Ynagi</option>
                                <option value="2" @if($s['status'] == 2) selected @endif>O'qiyotgan</option>
                                <option value="3" @if($s['status'] == 3) selected @endif>Bitirgan</option>
                                <option value="0" @if($s['status'] == 0) selected @endif>O'qimaydigan</option>
                            </select>
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
