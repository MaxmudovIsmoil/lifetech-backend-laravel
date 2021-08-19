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
{{--                                <th>Login</th>--}}
                                <th>Ism</th>
                                <th>Familiya</th>
                                <th>Mutaxasisligi</th>
                                <th>Telefon</th>
                                <th>OYLIK (%)</th>
                                <th width="15%" class="text-right">Harakatlar</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($teachers as $t)
                            <tr class="js_this_tr" data-id="{{ $t['id'] }}">
                                <td class="text-center">{{ ++$loop->index }}</td>
{{--                                <td>{{ $t['username'] }}</td>--}}
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
                                <td class="text-center">{{ 40 }}</td>
                                <td class="text-right">
                                    <div class="btn-group js_btn_group" role="group" aria-label="Basic example">
                                        <a href="{{ route('student.show', [$t['id']]) }}" class="js_show_student btn btn-warning btn-square btn-sm" title="Ko'rish" data-toggle="modal" data-target="#show{{ $t['id'] }}">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-low-vision') }}"></use>
                                            </svg>
                                        </a>
                                        {{-- Show Modal--}}
                                        @include('teacher.showModal')

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
