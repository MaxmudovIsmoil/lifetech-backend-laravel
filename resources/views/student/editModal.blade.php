<div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit-model-Lavel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-model-Lavel">{{ 'O\'quvchini tahrirlash' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="" class="js_modal_student_form form-group" id="js_modal_student_edit_form">
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
                                            <input class="form-check-input course_inputs" type="checkbox" name="course_{{$c->id}}" value="{{ $c->id }}">
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
                                    <label for="firstname">Ism</label>
                                    <input type="text" name="firstname" id="edit_firstname" class="form-control" />
                                    <div class="valid-feedback text-danger firstname_error">Ismni kiriting!</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_lastname">Familiya</label>
                                    <input type="text" class="form-control" name="lastname" id="edit_lastname" >
                                    <div class="valid-feedback text-danger lastname_error">Familiyani kiriting!</div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="edit_phone">Telefon 1</label>
                                    <input type="text" class="form-control phone-student" name="phone" id="edit_phone" >
                                    <div class="valid-feedback text-danger phone_error">Telefon nomerni kiriting!</div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="edit_phone2">Telefon 2</label>
                                    <input type="text" class="form-control phone-student" name="edit_phone2" id="edit_phone2">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="edit_address">Manzil</label>
                                    <input type="text" class="form-control" name="address" id="edit_address">
                                    <div class="valid-feedback text-danger address_error">Manzilni kiriting!</div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="edit_born">Tug'ulgan sana</label>
                                    <input type="date" class="form-control" name="born" id="edit_born">
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
                                    <input class="form-check-input" type="radio" name="gender" value="1" id="edit_gender1">
                                    <label class="form-check-label" for="edit_gender1">Erkak</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="gender" value="0" id="edit_gender2">
                                    <label class="form-check-label" for="edit_gender2">Ayol</label>
                                </div>
                                <div class="valid-feedback text-danger gender_error">Jinsni tnalang!</div>
                            </span>
                        </div>

                        <div class="col-md-4 mt-2">
                            <label for="edit_company">Ishxona / O'qish</label>
                            <input type="text" class="form-control" name="company" id="edit_company">
                            <div class="valid-feedback text-danger company_error">Ma'lumotni kiriting!</div>
                        </div>
                        <div class="col-md-4 mt-2">
                            <div class="form-group">
                                <label for="edit_advertising">Reklamani qayerda ko'rdingiz</label>
                                <select name="advertising" class="form-control" id="edit_advertising" >
                                    <option value="">---</option>
                                    @foreach($advertising as $ad)
                                        <option>{{ $ad->name }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback text-danger advertising_error">Tnalang!</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="edit_status">Maqomi</label>
                            <select class="form-control" id="edit_status" name="status">
                                <option value="">---</option>
                                <option value="1">Ynagi</option>
                                <option value="2">O'qiyotgan</option>
                                <option value="3">Bitirgan</option>
                                <option value="0">O'qimaydigan</option>
                            </select>
                            <div class="valid-feedback text-danger status_error">Tnalang!</div>
                        </div>
                        <div class="col-md-12 mt-2 d-none" id="edit_cause_div">
                            <label for="edit_cause">O'qimaslik sababi</label>
                            <input type="text" name="cause" id="edit_cause" class="form-control">
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
