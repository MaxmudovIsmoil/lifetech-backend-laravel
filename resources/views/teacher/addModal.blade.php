<div class="modal fade" id="add-model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-model-Lavel">{{ 'O\'qituvchi qo\'shish' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('teacher.store') }}" class="js_modal_teacher_form form-group">
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
                            <div class="valid-feedback text-danger course_error">Kursni tanlang!</div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="firstname">Ism</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control" value="{{ old('firstname') }}">
                                    <div class="valid-feedback text-danger firstname_error">Ismni kiriting!</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastname">Familiya</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname" value="{{ old('lastname') }}">
                                    <div class="valid-feedback text-danger lastname_error">Familiyani kiriting!</div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="phone">Telefon</label>
                                    <input type="text" class="form-control" name="phone" id="phone">
                                    <div class="valid-feedback text-danger phone_error">Telefon nomerni kiriting!</div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="address">Manzil</label>
                                    <input type="text" class="form-control" name="address" id="address">
                                    <div class="valid-feedback text-danger address_error">Manzilni kiriting!</div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label for="born">Tug'ulgan sana</label>
                                    <input type="date" class="form-control" name="born" id="born">
                                    <div class="valid-feedback text-danger born_error">Tug'ilgan sanani kiriting!</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="gender mt-3 pb-0" style="margin-top: 15px; margin-bottom: 0px;">Jins</label>
                                    <span class="mt-0 d-flex justify-content-around">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="gender" value="1" id="gender1" checked>
                                            <label class="form-check-label" for="gender1">Erkak</label>
                                        </div>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="gender" value="0" id="gender2">
                                            <label class="form-check-label" for="gender2">Ayol</label>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="company">Oldingi lavozimi</label>
                            <input type="text" class="form-control" name="company" id="company">
                            <div class="valid-feedback text-danger company_error">Ma'lumotni kiriting!</div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="username">Login</label>
                            <input type="text" class="form-control" name="username" id="username">
                            <span class="valid-feedback text-danger username_error">Loginni kiriting!</span>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="password">Parol</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <div class="valid-feedback text-danger password_error">Parolni kiriting!</div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="password_confirm">Parolni tasdiqlang</label>
                            <input type="password" class="form-control" name="password_confirm" id="password_confirm">
                            <div class="valid-feedback text-danger password_confirm_error">Parolni tasdiqlang!</div>
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
