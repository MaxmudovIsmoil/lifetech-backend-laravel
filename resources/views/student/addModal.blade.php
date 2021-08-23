<div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-model-Lavel">{{ 'O\'quvchi qo\'shish' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('student.store') }}" class="js_modal_student_form form-group">
                @csrf
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="h5">Kurslar</h4>
                            <div class="courses">
                                @foreach($course as $k => $c)
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="course_{{$c->id}}" value="{{ $c->id }}" id="course{{$c->id}}">
                                        <label class="form-check-label" for="course{{$c->id}}">{{ $c->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="valid-feedback text-danger course_error">Kursni tanlng!</div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="firstname">Ism </label>
                                    <input type="text" name="firstname" id="firstname" class="form-control" />
                                    <div class="valid-feedback text-danger firstname_error">Ismni kiriting!</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastname">Familiya </label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" />
                                    <div class="valid-feedback text-danger lastname_error">Familiyani kiriting!</div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="phone">Telefon 1 </label>
                                    <input type="text" class="form-control" name="phone" id="phone" />
                                    <div class="valid-feedback text-danger phone_error">Telefon nomerni kiriting!</div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="phone2">Telefon 2</label>
                                    <input type="text" class="form-control" name="phone2" id="phone2">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="address">Manzil </label>
                                    <input type="text" class="form-control" name="address" id="address">
                                    <div class="valid-feedback text-danger address_error">Manzilni kiriting!</div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="born">Tug'ulgan sana </label>
                                    <input type="date" class="form-control" name="born" id="born">
                                    <div class="valid-feedback text-danger born_error">Tug'lgan sanani kiriting!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-1">
                            <label for="gender mt-0 pb-0" style="margin-top: 15px; margin-bottom: 0px;">Jins </label>
                            <span class="mt-0 d-flex justify-content-around">
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="gender" value="1" id="gender1" checked>
                                    <label class="form-check-label" for="gender1">Erkak</label>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="radio" name="gender" value="0" id="gender2">
                                    <label class="form-check-label" for="gender2">Ayol</label>
                                </div>
                            </span>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="company">Ishxona / O'qish</label>
                            <input type="text" class="form-control" name="company" id="company">
                            <div class="valid-feedback text-danger company_error">Ma'lumotni kiriting!</div>
                        </div>
                        <div class="col-md-4 mt-2">
                            <div class="form-group">
                                <label for="advertising">Reklamani qayerda ko'rdingiz</label>
                                <select name="advertising" class="form-control" id="advertising">
                                    <option value="">---</option>
                                    @foreach($advertising as $ad)
                                        <option>{{ $ad->name }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback text-danger advertising_error">Tnalang!</div>
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
