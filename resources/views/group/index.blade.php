@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card groups">
                <div class="btn-group btn-square">
                    <a href="{{ route('group.index',[1]) }}" class="btn btn-square @if(Request::segment(2) == 1) btn-primary @else btn-secondary @endif">Yangi guruhlar</a>
                    <a href="{{route('group.index',[2])  }}" class="btn btn-square @if(Request::segment(2) == 2) btn-primary @else btn-secondary @endif">O'qiyotgan guruhlar</a>
                    <a href="{{ route('group.index',[3]) }}" class="btn btn-square @if(Request::segment(2) == 3) btn-primary @else btn-secondary @endif">Bitirgan guruhlar</a>
                </div>

                <div class="card-body" style="position: relative;">
                    <a href="" class="btn btn-square btn-primary" data-toggle="modal" data-target="#add-model" style="position: absolute; z-index: 1;">Qo'shish</a>

                    {{-- Add Modal--}}
                    <div class="modal fade" id="add-model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="add-model-Lavel">{{ 'Guruh qo\'shish' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="post" action="{{ route('group.store') }}" id="" class="form-group">
                                    @csrf
                                    <div class="modal-body text-left">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="course_id">Kurs</label>
                                                    <select name="course_id" class="form-control" id="course_id" required>
                                                        <option value="">---</option>
                                                        @foreach($course as $c)
                                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="valid-feedback text-danger">
                                                    Kursni tanlang !
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="teacher_id">O'qituvchi</label>
                                                    <select name="teacher_id" class="form-control" id="teacher_id" required>
                                                        <option value="">---</option>
                                                        @foreach($teachers as $t)
                                                            <option value="{{ $t->id }}">{{ $t->lastname." ".$t->firstname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="valid-feedback text-danger">
                                                    O'qituvchini tanlang !
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
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="name">Nomi</label>
                                                        <input type="text" name="name" id="name" class="form-control" required>
                                                        <div class="valid-feedback text-danger">
                                                            Nomini kiriting !
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-2">
                                                        <label for="time">Soati</label>
                                                        <input type="time" class="form-control" name="time" id="time" required>
                                                        <div class="valid-feedback text-danger">
                                                            Vaqtini kiriting !
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-2">
                                                        <div class="form-group">
                                                            <label for="month">Turi</label>
                                                            <select name="type" class="form-control" id="type" required>
                                                                <option value="1">Guruh</option>
                                                                <option value="2">Indvidual</option>
                                                            </select>
                                                        </div>
                                                        <div class="valid-feedback text-danger">
                                                            Narxni kiriting !
                                                        </div>
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
                    <table id="datatableCourse" class="display bg-info" style="width:100%;">
                        <thead>
                            <tr>
                                <th width="5%">№</th>
                                <th>Nomi</th>
                                <th>Kurs</th>
                                <th>O'qituvchi</th>
                                <th>Kunlari</th>
                                <th>Vaqti</th>
                                <th>Turi</th>
                                <th width="15%" class="text-right">Harakatlar</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($groups as $g)
                            <tr class="js_this_tr" data-id="{{ $g['id'] }}">
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $g['name'] }}</td>
                                <td>{{ $g['cname'] }}</td>
                                <td>{{ $g['lastname']." ".$g['firstname'] }}</td>
                                <td>
                                    @foreach($g['days'] as $k => $d)
                                        @if($d)
                                            <span class="badge">{{ $days[$k] }}</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $g['time'] }}</td>
                                <td>
                                    @if($g['type'] == 1)
                                        {{ 'Guruh' }}
                                    @else
                                    {{ 'Indvidual' }}
                                    @endif

                                </td>
                                <td class="text-right">
                                    <div class="btn-group js_btn_group" role="group" aria-label="Basic example">
                                        <a href="" class="js_edit_btn btn btn-success btn-square btn-sm" title="Тахрирлаш" data-toggle="modal" data-target="#addStudent{{ $g['id'] }}">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-user-follow') }}"></use>
                                            </svg>
                                        </a>
                                        <div class="modal fade" id="addStudent{{ $g['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addStudent-model-Lavel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="addStudent-model-Lavel">{{ 'Student qo\'shish' }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form method="post" action="{{ route('group.addStudentInGroup', [$g['id']]) }}" class="js_add_student_group_modal_from form-group">
                                                        @csrf
{{--                                                        {{ method_field('PUT') }}--}}
                                                        <div class="d-flex justify-content-around">
                                                            <p class="pt-2 mb-0">Yangilar</p>
                                                            <p class="pt-2 mb-0">Guruhdagilar</p>
                                                        </div>
                                                        <div class="modal-body text-left pb-0">
                                                            <select multiple="multiple" class="students_ingroup" name="students_ingroup[]">
                                                                @foreach($students as $k => $s)
                                                                    @foreach($s['course_ids'] as $k => $v)
                                                                        @if($v == $g['course_id'])
                                                                            <option value='{{ $s['id'] }}'>{{ $s['lastname']." ".$s['firstname']." ".$s['phone'] }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                                @foreach($group_students as $k => $gs)
                                                                    @if($gs->group_id == $g['id'])
                                                                        <option value='{{ $gs->student_id }}' selected>{{ $gs->lastname." ".$gs->firstname." ".$gs->phone }}</option>
                                                                    @endif;
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer mt-3 pb-0">
                                                            <input type="submit" value="Saqlash" class="btn btn-success btn-square">
                                                            <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Bekor qilish</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="" class="js_edit_btn btn btn-info btn-square btn-sm" title="Тахрирлаш" data-toggle="modal" data-target="#edit{{ $g['id'] }}">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                            </svg>
                                        </a>
                                        {{-- Edit Modal--}}
                                        <div class="modal fade" id="edit{{ $g['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit-model-Lavel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit-model-Lavel">{{ 'Kurs Tahrirlash' }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form method="post" action="{{ route('group.update', [$g['id']]) }}" class="form-group">
                                                        @csrf
                                                        {{ method_field('PUT') }}
                                                        <div class="modal-body text-left">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="course_id{{ $g['id'] }}">Kurs</label>
                                                                        <select name="course_id" class="form-control" id="course_id{{ $g['id'] }}" required>
                                                                            <option value="">---</option>
                                                                            @foreach($course as $c)
                                                                                <option value="{{ $c->id }}" @if($c->id == $g['course_id']) selected @endif>{{ $c->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="valid-feedback text-danger">
                                                                        Kursni tanlang !
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="teacher_id{{ $g['id'] }}">O'qituvchi</label>
                                                                        <select name="teacher_id" class="form-control" id="teacher_id{{ $g['id'] }}" required>
                                                                            <option value="">---</option>
                                                                            @foreach($teachers as $t)
                                                                                <option value="{{ $t->id }}" @if($t->id == $g['teacher_id']) selected @endif>{{ $t->lastname." ".$t->firstname }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="valid-feedback text-danger">
                                                                        O'qituvchini tanlang !
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
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label for="name{{ $g['id'] }}">Nomi</label>
                                                                            <input type="text" name="name" id="name{{ $g['id'] }}" class="form-control" value="{{ $g['name'] }}" required>
                                                                            <div class="valid-feedback text-danger">
                                                                                Nomini kiriting !
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 mt-2">
                                                                            <label for="time{{ $g['id'] }}">Soati</label>
                                                                            <input type="time" class="form-control" name="time" id="time{{ $g['id'] }}" value="{{ date("H:i", strtotime($g['time'])) }}" required>
                                                                            <div class="valid-feedback text-danger">
                                                                                Vaqtini kiriting !
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 mt-2">
                                                                            <div class="form-group">
                                                                                <label for="type{{ $g['id'] }}">Turi</label>
                                                                                <select name="type" class="form-control" id="type{{ $g['id'] }}" required>
                                                                                    <option value="1" @if($g['type'] == 1) selected @endif>Guruh</option>
                                                                                    <option value="2" @if($g['type'] == 2) selected @endif>Indvidual</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="valid-feedback text-danger">
                                                                                tipini kiriting !
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 mt-2">
                                                                            <div class="form-group">
                                                                                <label for="status{{ $g['id'] }}">Status</label>
                                                                                <select name="status" class="form-control" id="status{{ $g['id'] }}" required>
                                                                                    <option value="1" @if($g['status'] == 1) selected @endif>Ynagi</option>
                                                                                    <option value="2" @if($g['status'] == 2) selected @endif>O'qiyotgan</option>
                                                                                    <option value="3" @if($g['status'] == 3) selected @endif>Bitirgan</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="valid-feedback text-danger">
                                                                                tipini kiriting !
                                                                            </div>
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

                                        <button type="button" data-url="{{ route('group.destroy', [$g['id']]) }}" data-name="{{ $g['name'] }}" class="btn btn-danger js_delete_btn btn-square btn-sm" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
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
