@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card students">

                <div class="card-body" style="position: relative;">
                    <a href="" class="btn btn-square btn-primary" data-toggle="modal" data-target="#add-model" style="position: absolute; z-index: 1;">Qo'shish</a>

                    {{-- Add Modal--}}
                    <div class="modal fade" id="add-model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="add-model-Lavel">{{ 'O\'qituvchi qo\'shish' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="post" action="{{ route('teacher.store') }}" id="js_modal_add_teacher_form" class="form-group needs-validation" novalidate="novalidate">
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
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="firstname">Ism  </label>
                                                        <input type="text" name="firstname" id="firstname" class="form-control" required>
                                                        <div class="invalid-feedback">
                                                            Ismni kiriting!
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="lastname">Familiya  </label>
                                                        <input type="text" class="form-control" name="lastname" id="lastname" required>
                                                        <div class="invalid-feedback">
                                                            Familiyani kiriting!
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <label for="phone">Telefon  </label>
                                                        <input type="text" class="form-control" name="phone" id="phone" required>
                                                        <div class="invalid-feedback">
                                                            Telefon nomerni kiriting!
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <label for="address">Manzil  </label>
                                                        <input type="text" class="form-control" name="address" id="address" required>
                                                        <div class="invalid-feedback">
                                                            Manzilni kiriting!
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <label for="born">Tug'ulgan sana</label>
                                                        <input type="date" class="form-control" name="born" id="born" required>
                                                        <div class="invalid-feedback">
                                                            Tug'ilgan sanani kiriting!
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="gender mt-3 pb-0" style="margin-top: 15px; margin-bottom: 0px;">Jins</label>
                                                        <span class="mt-0 d-flex justify-content-around">
                                                            <div class="form-check mt-2">
                                                                <input class="form-check-input" type="radio" name="gender" value="1" id="gender1">
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
                                                <input type="text" class="form-control" name="company" id="company" required>
                                                <div class="invalid-feedback">
                                                    Oldingi lavozimi haqida ma'lumot kiriting!
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="username">Login</label>
                                                <input type="text" class="form-control" name="username" id="username" required>
                                                <span class="invalid-feedback username-error">
                                                    Loginni kiriting!
                                                </span>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="password">Parol</label>
                                                <input type="password" class="form-control" name="password" id="password" required>
                                                <div class="invalid-feedback password-error">
                                                    Parolni kiriting!
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="password_confirm">Parolni tasdiqlang</label>
                                                <input type="password" class="form-control" name="password_confirm" id="password_confirm" required>
                                                <div class="invalid-feedback password-confirm-error">
                                                    Parolni tasdiqlang!
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
                    <table id="datatableTeacher" class="display bg-info" style="width:100%;">
                        <thead>
                            <tr>
                                <th width="6%">№</th>
                                <th>Login</th>
                                <th>Ism</th>
                                <th>Familiya</th>
                                <th>Mutaxasisligi</th>
                                <th>Telefon</th>
                                <th width="15%" class="text-right">Harakatlar</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($teachers as $t)
                            <tr class="js_this_tr" data-id="{{ $t['id'] }}">
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $t['username'] }}</td>
                                <td>{{ $t['firstname'] }}</td>
                                <td>{{ $t['lastname'] }}</td>
                                <td>
                                    @foreach($course as $k => $c)
                                        @if(in_array($c->id, $t['course_ids']))
                                            {{  $c->name }}<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $t['phone'] }}</td>
                                <td class="text-right">
                                    <div class="btn-group js_btn_group" role="group" aria-label="Basic example">
                                        <a href="{{ route('student.show', [$t['id']]) }}" class="js_show_student btn btn-warning btn-square btn-sm" title="Ko'rish" data-toggle="modal" data-target="#show{{ $t['id'] }}">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-low-vision') }}"></use>
                                            </svg>
                                        </a>
                                        {{-- Show Modal--}}
                                        <div class="modal fade" id="show{{ $t['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit-model-Lavel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit-model-Lavel">{{ 'O\'qituvchi haqida to\'liq ma\'lumot' }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                        <div class="modal-body text-left pb-0">
                                                            <table class="table table-striped table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>№</th>
                                                                        <th width="46%">First</th>
                                                                        <th width="46%">Last</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <th>1</th>
                                                                        <td>Ismi</td>
                                                                        <td>{{ $t['firstname'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>2</th>
                                                                        <td>Familiyasi</td>
                                                                        <td>{{ $t['lastname'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>3</th>
                                                                        <td>Telefon nomeri</td>
                                                                        <td>{{ $t['phone'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>4</th>
                                                                        <td>Manzili</td>
                                                                        <td>{{ $t['address'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>5</th>
                                                                        <td>Jinsi</td>
                                                                        <td>@if($t['gender'] == 1) {{ 'erkak' }} @else {{ 'ayol' }} @endif</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>6</th>
                                                                        <td>Avvalgi valozimi</td>
                                                                        <td>{{ $t['company'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="align-middle">8</th>
                                                                        <td class="align-middle">Mutaxassisligi</td>
                                                                        <td>
                                                                            @foreach($course as $c)
                                                                                @if(in_array($c->id, $t['course_ids']))
                                                                                    {{ $c->name }}<br>
                                                                                @endif
                                                                            @endforeach
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>9</th>
                                                                        <td>Maqomi</td>
                                                                        <td>
                                                                            @if($t['status'] == 1)
                                                                                {{ 'yangi sinovda' }}
                                                                            @elseif($t['status'] == 2)
                                                                                {{ 'Falo hodim' }}
                                                                            @elseif($t['status'] == 3)
                                                                                {{ 'Ishdan ketgan' }}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>10</th>
                                                                        <td>Kelgan sanasi</td>
                                                                        <td>{{ date('d.m.Y H:i', strtotime($t['created_at'])) }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer mt-0">
                                                            <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Bekor qilish</button>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="" class="js_edit_btn btn btn-info btn-square btn-sm" title="Тахрирлаш" data-toggle="modal" data-target="#edit{{ $t['id'] }}">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                            </svg>
                                        </a>
                                        {{-- Edit Modal--}}
                                        <div class="modal fade" id="edit{{ $t['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit-model-Lavel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit-model-Lavel">{{ 'O\'qituvchini tahrirlash' }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form method="post" action="{{ route('teacher.update',[$t['id']]) }}" class="js_modal_edit_teacher_form form-group needs-validation" novalidate="novalidate">
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
                                                                                        <input class="form-check-input" type="checkbox" @if(in_array($c->id, $t['course_ids'])) checked @endif name="course_{{$c->id}}" value="{{ $c->id }}">
                                                                                        {{ $c->name }}
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label for="firstname{{ $t['id'] }}">Ism  </label>
                                                                                <input type="text" name="firstname" id="firstname{{ $t['id'] }}" class="form-control" value="{{ $t['firstname'] }}" required>
                                                                                <div class="invalid-feedback">
                                                                                    Ismni kiriting!
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="lastname{{ $t['id'] }}">Familiya  </label>
                                                                                <input type="text" class="form-control" name="lastname" id="lastname{{ $t['id'] }}" value="{{ $t['lastname'] }}" required>
                                                                                <div class="invalid-feedback">
                                                                                    Familiyani kiriting!
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 mt-2">
                                                                                <label for="phone{{ $t['id'] }}">Telefon  </label>
                                                                                <input type="text" class="form-control" name="phone" id="phone{{ $t['id'] }}" value="{{ substr($t['phone'], 4) }}" required>
                                                                                <div class="invalid-feedback">
                                                                                    Telefon nomerni kiriting!
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 mt-2">
                                                                                <label for="address{{ $t['id'] }}">Manzil  </label>
                                                                                <input type="text" class="form-control" name="address" id="address{{ $t['id'] }}" value="{{ $t['address'] }}" required>
                                                                                <div class="invalid-feedback">
                                                                                    Manzilni kiriting!
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 mt-2">
                                                                                <label for="born{{ $t['id'] }}">Tug'ulgan sana</label>
                                                                                <input type="date" class="form-control" name="born" id="born{{ $t['id'] }}" value="{{ $t['born'] }}" required>
                                                                                <div class="invalid-feedback">
                                                                                    Tug'ilgan sanani kiriting!
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="gender mt-3 pb-0" style="margin-top: 15px; margin-bottom: 0px;">Jins</label>
                                                                                <span class="mt-0 d-flex justify-content-around">
                                                                                    <div class="form-check mt-2">
                                                                                        <input class="form-check-input" @if($t['gender'] == 1) checked @endif type="radio" name="gender" value="1" id="gender1{{ $t['id'] }}">
                                                                                        <label class="form-check-label" for="gender1{{ $t['id'] }}">Erkak</label>
                                                                                    </div>
                                                                                    <div class="form-check mt-2">
                                                                                        <input class="form-check-input" @if($t['gender'] == 0) checked @endif type="radio" name="gender" value="0" id="gender2{{ $t['id'] }}">
                                                                                        <label class="form-check-label" for="gender2{{ $t['id'] }}">Ayol</label>
                                                                                    </div>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 mt-2">
                                                                        <label for="company{{ $t['id'] }}">Oldingi lavozimi</label>
                                                                        <input type="text" class="form-control" name="company" id="company{{ $t['id'] }}" value="{{ $t['company'] }}" required>
                                                                        <div class="invalid-feedback">
                                                                            Oldingi lavozimi haqida ma'lumot kiriting!
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 mt-2">
                                                                        <label for="username{{ $t['id'] }}">Login</label>
                                                                        <input type="text" class="form-control" name="username" id="username{{ $t['id'] }}" value="{{ $t['username'] }}" readonly>
                                                                        <span class="invalid-feedback username-error">
                                                                        Loginni kiriting!
                                                                    </span>
                                                                    </div>
                                                                    <div class="col-md-6 mt-2">
                                                                        <label for="password{{ $t['id'] }}">Parol</label>
                                                                        <input type="password" class="form-control" name="password" id="password{{ $t['id'] }}">
                                                                        <div class="invalid-feedback password-error">
                                                                            Parolni kiriting!
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 mt-2">
                                                                        <label for="password_confirm{{ $t['id'] }}">Parolni tasdiqlang</label>
                                                                        <input type="password" class="form-control" name="password_confirm" id="password_confirm{{ $t['id'] }}">
                                                                        <div class="invalid-feedback password-confirm-error">
                                                                            Parolni tasdiqlang!
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

                                        <button type="button" data-url="{{ route('teacher.destroy', [$t['id']]) }}" data-name="{{ $t['firstname'] }}" class="btn btn-danger js_delete_btn btn-square btn-sm" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                            <svg class="c-icon c-icon-lg" title="O'chirish">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-trash') }}"></use>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
