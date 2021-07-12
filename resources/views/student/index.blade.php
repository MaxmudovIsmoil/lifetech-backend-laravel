@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card students">
                <div class="btn-group btn-square">
                    <a href="{{ route('student.index',[1]) }}" class="btn btn-square @if(Request::segment(2) == 1) btn-primary @else btn-secondary @endif">Yangi kelganlar</a>
                    <a href="{{route('student.index',[2])  }}" class="btn btn-square @if(Request::segment(2) == 2) btn-primary @else btn-secondary @endif">O'qiyotganlar</a>
                    <a href="{{ route('student.index',[3]) }}" class="btn btn-square @if(Request::segment(2) == 3) btn-primary @else btn-secondary @endif">Bitirganlar</a>
                </div>
                <div class="card-body" style="position: relative;">
                    <a href="" class="btn btn-square btn-primary" data-toggle="modal" data-target="#add-model" style="position: absolute; z-index: 1;">Qo'shish</a>

                    {{-- Add Modal--}}
                    <div class="modal fade" id="add-model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="add-model-Lavel">{{ 'O\'quvchi qo\'shish' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="post" action="{{ route('student.store') }}" id="js_modal_add_student_form" class="form-group">
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
                                                        <label for="firstname">Ism <i class="text-danger">*</i></label>
                                                        <input type="text" name="firstname" id="firstname" class="form-control" required>
                                                        <div class="valid-feedback text-danger">
                                                            Ismni kiriting!
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="lastname">Familiya <i class="text-danger">*</i></label>
                                                        <input type="text" class="form-control" name="lastname" id="lastname" required>
                                                        <div class="valid-feedback text-danger">
                                                            Familiyani kiriting!
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <label for="phone">Telefon <i class="text-danger">*</i></label>
                                                        <input type="text" class="form-control" name="phone" id="phone" required>
                                                        <div class="valid-feedback text-danger">
                                                            Telefon nomerni kiriting!
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <label for="address">Manzil <i class="text-danger">*</i></label>
                                                        <input type="text" class="form-control" name="address" id="address">
                                                        <div class="valid-feedback text-danger">
                                                            Manzilni kiriting!
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-2">
                                                        <label for="born">Tug'ulgan sana</label>
                                                        <input type="date" class="form-control" name="born" id="born">
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
                                                <label for="company">Ishxona / O'qish</label>
                                                <input type="text" class="form-control" name="company" id="company">
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="advertising">Reklamani qayerda ko'rdingiz</label>
                                                <input type="text" class="form-control" name="advertising" id="advertising">
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
                    <table id="datatableStudent" class="display bg-info" style="width:100%;">
                        <thead>
                            <tr>
                                <th width="6%">№</th>
                                <th>Ism</th>
                                <th>Familiya</th>
                                <th>Telefon</th>
                                <th>Tanlagan kursi</th>
                                <th>status</th>
                                <th>Kelgan sana</th>
                                <th width="15%" class="text-right">Harakatlar</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($students as $s)
                            <tr class="js_this_tr" data-id="{{ $s['id'] }}">
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $s['firstname'] }}</td>
                                <td>{{ $s['lastname'] }}</td>
                                <td>{{ $s['phone'] }}</td>
                                <td>
                                    @foreach($course as $k => $c)
                                        @if(in_array($c->id, $s['course_ids']))
                                            {{  $c->name }}<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if($s['status'] == 1)
                                        {{ 'yangi' }}
                                    @elseif($s['status'] == 2)
                                        {{ 'o\'qiyotgan' }}
                                    @elseif($s['status'] == 3)
                                        {{ 'bitirgan' }}
                                    @endif

                                </td>
                                <td>{{ date('d.m.Y H:i', strtotime($s['created_at'])) }}</td>
                                <td class="text-right">
                                    <div class="btn-group js_btn_group" role="group" aria-label="Basic example">
                                        <a href="{{ route('student.student_active_groups', [$s['id']]) }}" class="js_student_payment_btn btn btn-success btn-square btn-sm" title="Ko'rish" data-toggle="modal" data-target="#payment{{ $s['id'] }}">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-dollar') }}"></use>
                                            </svg>
                                        </a>
                                        {{-- Student Payments Modal--}}
                                        <div class="modal fade" id="payment{{ $s['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="payment-model-Lavel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="payment-model-Lavel">{{ $s['lastname']." ".$s['firstname'].' to\'lovlari' }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-left pb-0">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <select name="student_active_group" class="form-control js_student_active_group mb-3"></select>
                                                                <table class="table table-striped table-bordered js_student_payment_table"></table>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <p>To'lov qilish</p>
                                                                <form method="post" action="" data-student_id="{{ $s['id'] }}" class="form-group js_student_payment_in_group_form_modal">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <input type="text" name="paid" class="form-control paid" value="" placeholder="Summani kiriting!">
                                                                            <div class="valid-feedback paid-error text-danger">
                                                                                Summani kiriting!
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mt-3">
                                                                            <select class="form-control payment_type" name="payment_type">
                                                                                <option value="1">Naqt</option>
                                                                                <option value="2">Plastic</option>
                                                                                <option value="3">Click</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-12 mt-3">
                                                                            <select class="form-control discount_type" name="discount_type">
                                                                                <option value="0">-Chegirma-</option>
                                                                                <option value="1">so'm</option>
                                                                                <option value="2">foiz</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-12 mt-3 mb-2">
                                                                            <input type="number" name="discount_val" class="form-control discount_val d-none" value="" placeholder="Chegirmani kiriting!">
                                                                            <div class="valid-feedback discount-val-error text-danger">
                                                                                Chegirmani kiriting!
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12 mt-1">
                                                                            <button type="submit" class="btn btn-success btn-block">Saqlash</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer mt-0">
                                                        <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Bekor qilish</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{ route('student.show', [$s['id']]) }}" class="js_show_student btn btn-warning btn-square btn-sm" title="Ko'rish" data-toggle="modal" data-target="#show{{ $s['id'] }}">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-low-vision') }}"></use>
                                            </svg>
                                        </a>
                                        {{-- Show Modal--}}
                                        <div class="modal fade" id="show{{ $s['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit-model-Lavel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit-model-Lavel">{{ 'O\'quvchi haqida to\'liq ma\'lumot' }}</h5>
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
                                                                        <td>{{ $s['firstname'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>2</th>
                                                                        <td>Familiyasi</td>
                                                                        <td>{{ $s['lastname'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>3</th>
                                                                        <td>Telefon nomeri</td>
                                                                        <td>{{ $s['phone'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>4</th>
                                                                        <td>Manzili</td>
                                                                        <td>{{ $s['address'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>5</th>
                                                                        <td>Jinsi</td>
                                                                        <td>@if($s['gender'] == 1) {{ 'erkak' }} @else {{ 'ayol' }} @endif</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>6</th>
                                                                        <td>Ishi / o'qishi</td>
                                                                        <td>{{ $s['company'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>7</th>
                                                                        <td>Reklamani qayerda ko'rganligi</td>
                                                                        <td>{{ $s['advertising'] }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="align-middle">8</th>
                                                                        <td class="align-middle">Tanlagan kurslari</td>
                                                                        <td>
                                                                            @foreach($course as $c)
                                                                                @if(in_array($c->id, $s['course_ids']))
                                                                                    {{ $c->name }}<br>
                                                                                @endif
                                                                            @endforeach
                                                                        </td>
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
                                        <a href="" class="js_edit_btn btn btn-info btn-square btn-sm" title="Тахрирлаш" data-toggle="modal" data-target="#edit{{ $s['id'] }}">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                            </svg>
                                        </a>
                                        {{-- Edit Modal--}}
                                        <div class="modal fade" id="edit{{ $s['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit-model-Lavel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit-model-Lavel">{{ 'O\'quvchini tahrirlash' }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post" action="{{ route('student.update',[$s['id']]) }}" class="js_modal_add_form form-group">
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
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label for="firstname{{ $s['id'] }}">Ism <i class="text-danger">*</i></label>
                                                                                <input type="text" name="firstname" id="firstname{{ $s['id'] }}" class="form-control" value="{{ $s['firstname'] }}" required>
                                                                                <div class="valid-feedback text-danger">
                                                                                    Ismni kiriting!
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="lastname{{ $s['id'] }}">Familiya <i class="text-danger">*</i></label>
                                                                                <input type="text" class="form-control" name="lastname" id="lastname{{ $s['id'] }}" value="{{ $s['lastname'] }}" required>
                                                                                <div class="valid-feedback text-danger">
                                                                                    Familiyani kiriting!
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 mt-2">
                                                                                <label for="phone{{ $s['id'] }}">Telefon <i class="text-danger">*</i></label>
                                                                                <input type="text" class="form-control phone-student" name="phone" id="phone{{ $s['id'] }}" value="{{ $s['phone'] }}" required>
                                                                                <div class="valid-feedback text-danger">
                                                                                    Telefon nomerni kiriting!
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 mt-2">
                                                                                <label for="address{{ $s['id'] }}">Manzil <i class="text-danger">*</i></label>
                                                                                <input type="text" class="form-control" name="address" id="address{{ $s['id'] }}" value="{{ $s['address'] }}">
                                                                                <div class="valid-feedback text-danger">
                                                                                    Manzilni kiriting!
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 mt-2">
                                                                                <label for="born{{ $s['id'] }}">Tug'ulgan sana</label>
                                                                                <input type="date" class="form-control" name="born" id="born{{ $s['id'] }}" value="{{ $s['born'] }}">
                                                                            </div>
                                                                            <div class="col-md-6">
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

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4 mt-2">
                                                                        <label for="company{{ $s['id'] }}">Ishxona / O'qish</label>
                                                                        <input type="text" class="form-control" name="company" id="company{{ $s['id'] }}" value="{{ $s['company'] }}">
                                                                    </div>
                                                                    <div class="col-md-4 mt-2">
                                                                        <label for="advertising{{ $s['id'] }}">Reklamani qayerda ko'rdingiz</label>
                                                                        <input type="text" class="form-control" name="advertising" id="advertising{{ $s['id'] }}">
                                                                    </div>
                                                                    <div class="col-md-4 mt-2">
                                                                        <label for="status{{ $s['id'] }}">Maqomi</label>
                                                                        <select class="form-control" id="status{{ $s['id'] }}" name="status">
                                                                            <option>---</option>
                                                                            <option value="1" @if($s['status'] == 1) selected @endif>Ynagi</option>
                                                                            <option value="2" @if($s['status'] == 2) selected @endif>O'qiyotgan</option>
                                                                            <option value="3" @if($s['status'] == 3) selected @endif>Bitirgan</option>
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

                                        <button type="button" data-url="{{ route('student.destroy', [$s['id']]) }}" data-name="{{ $s['firstname'] }}" class="btn btn-danger js_delete_btn btn-square btn-sm" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
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
