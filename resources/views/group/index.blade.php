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
                    @include('group.addModal')

                    <table id="datatableGroup" class="display bg-info" style="width:100%;">
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
                                        <a href="" class="js_edit_btn btn btn-warning btn-square btn-sm" title="O'quvchilar" data-toggle="modal" data-target="#showStudent{{ $g['id'] }}">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-people') }}"></use>
                                            </svg>
                                        </a>
                                        {{-- Students in group --}}
                                        @include('group.showStudents')

                                        @if(Request::segment(2) == '1' || Request::segment(2) == '2')
                                            <a href="" class="js_edit_btn btn btn-success btn-square btn-sm" title="Student qo'shish" data-toggle="modal" data-target="#addStudent{{ $g['id'] }}">
                                                <svg class="c-icon c-icon-lg">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-user-follow') }}"></use>
                                                </svg>
                                            </a>
                                            {{-- Student add in group Modal --}}
                                            @include('group.addStudent')
                                        @endif

                                        <a href="" class="js_edit_btn btn btn-info btn-square btn-sm" title="Tahrirlash" data-toggle="modal" data-target="#edit{{ $g['id'] }}">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                            </svg>
                                        </a>

                                        {{-- Edit Modal--}}
                                        @include('group.editModal')

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
