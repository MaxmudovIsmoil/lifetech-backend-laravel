@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card students">

                <div class="card-body" style="position: relative;">
                    <a href="" class="btn btn-square btn-primary" data-toggle="modal" data-target="#add-model" style="position: absolute; z-index: 1;">Qo'shish</a>

                    {{-- Add Modal--}}
                    @include('teacher.addModal')

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
                                <td>{{ substr($t['phone'], 4) }}</td>
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
                                        @include('teacher.editModal')

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
