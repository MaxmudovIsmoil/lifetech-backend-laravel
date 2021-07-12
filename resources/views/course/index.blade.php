@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body" style="position: relative;">
                    <a href="" class="btn btn-square btn-primary" data-toggle="modal" data-target="#add-model" style="position: absolute; z-index: 1;">Qo'shish</a>

                    {{-- Add Modal--}}
                    <div class="modal fade" id="add-model" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-model-Lavel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="add-model-Lavel">{{ 'Kurs qo\'shish' }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="post" action="{{ route('course.store') }}" id="js_modal_add_form" class="form-group">
                                    @csrf
                                    <div class="modal-body text-left">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="name">Nomi</label>
                                                <input type="text" name="name" id="name" class="form-control" required>
                                                <div class="valid-feedback text-danger">
                                                    Ma'lumotni kiriting !
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <label for="price">Narxi</label>
                                                <input type="number" class="form-control" name="price" id="price" required>
                                                <div class="valid-feedback text-danger">
                                                    Narxni kiriting !
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <div class="form-group">
                                                    <label for="month">Muddati</label>
                                                    <select name="month" class="form-control" id="month" required>
                                                        <option value="">---</option>
                                                        <option value="1">1 Oy</option>
                                                        <option value="2">2 Oy</option>
                                                        <option value="3">3 Oy</option>
                                                        <option value="4">4 Oy</option>
                                                        <option value="5">5 Oy</option>
                                                        <option value="6">6 Oy</option>
                                                        <option value="7">7 Oy</option>
                                                        <option value="8">8 Oy</option>
                                                        <option value="9">9 Oy</option>
                                                        <option value="10">10 Oy</option>
                                                    </select>
                                                </div>
                                                <div class="valid-feedback text-danger">
                                                    Narxni kiriting !
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
                                    <div class="btn-group js_btn_group" role="group" aria-label="Basic example">
                                        <a href="" class="js_edit_btn btn btn-info btn-square btn-sm" title="Тахрирлаш" data-toggle="modal" data-target="#edit{{ $cor->id }}">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                            </svg>
                                        </a>
                                        {{-- Edit Modal--}}
                                        <div class="modal fade" id="edit{{ $cor->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit-model-Lavel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit-model-Lavel">{{ 'Kurs Tahrirlash' }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post" action="{{ route('course.update',[ $cor->id ]) }}" class="js_modal_add_form form-group">
                                                        @csrf
                                                        {{ method_field('PUT') }}

                                                        <div class="modal-body text-left">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="name{{ $cor->id }}">Nomi</label>
                                                                    <input type="text" name="name" id="name{{ $cor->id }}" class="form-control" value="{{ $cor->name }}" required>
                                                                    <div class="valid-feedback text-danger">
                                                                        Ma'lumotni kiriting !
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mt-2">
                                                                    <label for="price{{ $cor->id }}">Narxi</label>
                                                                    <input type="number" class="form-control" name="price" id="price{{ $cor->id }}" value="{{ $cor->price }}" required>
                                                                    <div class="valid-feedback text-danger">
                                                                        Narxni kiriting !
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mt-2">
                                                                    <div class="form-group">
                                                                        <label for="month{{ $cor->id }}">Muddati</label>
                                                                        <select name="month" class="form-control" id="month{{ $cor->id }}" required>
                                                                            <option value="">---</option>
                                                                            <option @if($cor->month == 1) selected @endif value="1">1 Oy</option>
                                                                            <option @if($cor->month == 2) selected @endif value="2">2 Oy</option>
                                                                            <option @if($cor->month == 3) selected @endif value="3">3 Oy</option>
                                                                            <option @if($cor->month == 4) selected @endif value="4">4 Oy</option>
                                                                            <option @if($cor->month == 5) selected @endif value="5">5 Oy</option>
                                                                            <option @if($cor->month == 6) selected @endif value="6">6 Oy</option>
                                                                            <option @if($cor->month == 7) selected @endif value="7">7 Oy</option>
                                                                            <option @if($cor->month == 8) selected @endif value="8">8 Oy</option>
                                                                            <option @if($cor->month == 9) selected @endif value="9">9 Oy</option>
                                                                            <option @if($cor->month == 10) selected @endif value="10">10 Oy</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="valid-feedback text-danger">
                                                                        Mudatni tanlang!
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

                                        <button type="button" data-url="{{ route('course.destroy', [$cor->id]) }}" data-name="{{ $cor->name }}" class="btn btn-danger js_delete_btn btn-square btn-sm" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
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
