@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body" style="position: relative;">
                    <a href="" class="btn btn-square btn-primary" data-toggle="modal" data-target="#add-model" style="position: absolute; z-index: 1;">Qo'shish</a>

                    {{-- Add Modal--}}
                    @include('course.addModal')

                    <table id="datatableCourse" class="display bg-info" style="width:100%;">
                        <thead>
                            <tr>
                                <th width="6%">№</th>
                                <th width="35%">Nomi</th>
                                <th>Narxi</th>
                                <th>Mudati</th>
                                <th width="15%" class="text-right">Harakatlar</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($course as $cor)
                            <tr class="js_this_tr" data-id="{{ $cor->id }}">
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $cor->name }}</td>
                                <td>{{ number_format($cor->price, 0, '.', ' ') }}</td>
                                <td>{{ $cor->month." oy" }}</td>
                                <td class="text-right">
                                    <div class="dropdown d-inline-block">
                                        <svg class="c-icon c-icon-lg" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-options') }}"></use>
                                        </svg>
                                        <div class="dropdown-menu pt-0 pb-0" aria-labelledby="dropdownMenuButton">

                                            <a href="" class="dropdown-item js_edit_btn btn-sm" title="Тахрирлаш" data-toggle="modal" data-target="#edit{{ $cor->id }}">
                                                <svg class="c-icon c-icon-md mr-2">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                                </svg> Tahrirlash
                                            </a>
                                            <button type="button" data-url="{{ route('course.destroy', [$cor->id]) }}" data-name="{{ $cor->name }}" class="dropdown-item js_delete_btn btn-sm" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                                <svg class="c-icon c-icon-md mr-2" title="O'chirish">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-trash') }}"></use>
                                                </svg> O'chirish
                                            </button>
                                        </div>
                                    </div>
                                    {{-- Edit Modal--}}
                                    @include('course.editModal')

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

@section('script')
    <script src="{{ asset('js/functionCourse.js') }}"></script>
@endsection
