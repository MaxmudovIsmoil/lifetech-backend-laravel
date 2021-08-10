@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card students">
                <div class="btn-group btn-square">
                    <a href="{{ route('student.index',[1]) }}" class="btn btn-square @if(Request::segment(2) == 1) btn-primary @else btn-secondary @endif">Yangi kelganlar</a>
                    <a href="{{ route('student.index',[2]) }}" class="btn btn-square @if(Request::segment(2) == 2) btn-primary @else btn-secondary @endif">O'qiyotganlar</a>
                    <a href="{{ route('student.index',[3]) }}" class="btn btn-square @if(Request::segment(2) == 3) btn-primary @else btn-secondary @endif">Bitirganlar</a>
                    <a href="{{ route('student.index',[0]) }}" class="btn btn-square @if(Request::segment(2) == 0) btn-primary @else btn-secondary @endif">O'qimaganlar</a>
                </div>
                <div class="card-body" style="position: relative;">
                    <a href="" class="btn btn-square btn-primary" data-toggle="modal" data-target="#add-model" style="position: absolute; z-index: 1;">Qo'shish</a>

                    {{-- Add Modal--}}
                    @include('student.addModal')

                    <table id="datatableStudent" class="display bg-info" style="width:100%;">
                        <thead>
                            <tr>
                                <th width="4%">№</th>
                                <th>Ism</th>
                                <th>Familiya</th>
                                <th width="12%">Telefon</th>
                                <th>Tanlagan kursi</th>
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
                                <td>{{ substr($s['phone'], 4) }}</td>
                                <td>
                                    @foreach($course as $k => $c)
                                        @if(in_array($c->id, $s['course_ids']))
                                            {{  $c->name }}<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ date('d.m.Y H:i', strtotime($s['created_at'])) }}</td>
                                <td class="text-right">
                                    <div class="btn-group js_btn_group" role="group" aria-label="Basic example">

                                        @if(Request::segment(2) == '2' || Request::segment(2) == '3')
                                            <a href="{{ route('student.student_active_groups', [$s['id']]) }}" class="js_student_payment_btn btn btn-success btn-square btn-sm" title="To'lov" data-toggle="modal" data-target="#payment{{ $s['id'] }}">
                                                <svg class="c-icon c-icon-lg">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-dollar') }}"></use>
                                                </svg>
                                            </a>
                                            {{-- Student Payments Modal--}}
                                            @include('student.paymentModal')
                                        @endif

                                        <a href="{{ route('student.show', [$s['id']]) }}" class="js_show_student btn btn-warning btn-square btn-sm" title="Ko'rish" data-toggle="modal" data-target="#show{{ $s['id'] }}">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-low-vision') }}"></use>
                                            </svg>
                                        </a>
                                        {{-- Show Modal--}}
                                        @include('student.showModal')

                                        <a href="" class="js_edit_btn btn btn-info btn-square btn-sm" title="Тахрирлаш" data-toggle="modal" data-target="#edit{{ $s['id'] }}">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                            </svg>
                                        </a>
                                        {{-- Edit Modal--}}
                                        @include('student.editModal')

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
