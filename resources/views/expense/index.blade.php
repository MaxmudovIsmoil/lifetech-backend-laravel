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

                                <form method="post" action="{{ route('expense.store') }}" id="js_modal_add_form" class="form-group">
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
                                                <label for="money">Narxi</label>
                                                <input type="number" class="form-control" name="money" id="money" required>
                                                <div class="valid-feedback text-danger">
                                                    Narxni kiriting !
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <div class="form-group">
                                                    <label for="cost_id">Harajat turi</label>
                                                    <select name="cost_id" class="form-control" id="cost_id" required>
                                                        <option value="">---</option>
                                                        @foreach($costs as $c)
                                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="valid-feedback text-danger">
                                                    Harajat turini tanlang!
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
                                <th>Nomi</th>
                                <th>Summasi</th>
                                <th>Harajat turi</th>
                                <th>Harajat vaqti</th>
                                <th width="15%" class="text-right">Harakatlar</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($expense as $exp)
                            <tr class="js_this_tr" data-id="{{ $exp->id }}">
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $exp->name }}</td>
                                <td>{{ number_format($exp->money, 0, '.', ' ') }}</td>
                                <td>{{ $exp->cname }}</td>
                                <td>{{ date("d.m.Y H : i", strtotime($exp->created_at)) }}</td>
                                <td class="text-right">
                                    <div class="btn-group js_btn_group" role="group" aria-label="Basic example">
                                        <a href="" class="js_edit_btn btn btn-info btn-square btn-sm" title="Тахрирлаш" data-toggle="modal" data-target="#edit{{ $exp->id }}">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                            </svg>
                                        </a>
                                        {{-- Edit Modal--}}
                                        <div class="modal fade" id="edit{{ $exp->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="edit-model-Lavel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="edit-model-Lavel">{{ 'Kurs Tahrirlash' }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post" action="{{ route('expense.update',[ $exp->id ]) }}" class="js_modal_add_form form-group">
                                                        @csrf
                                                        {{ method_field('PUT') }}

                                                        <div class="modal-body text-left">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="name{{ $exp->id }}">Nomi</label>
                                                                    <input type="text" name="name" id="name{{ $exp->id }}" class="form-control" value="{{ $exp->name }}" required>
                                                                    <div class="valid-feedback text-danger">
                                                                        Ma'lumotni kiriting !
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mt-2">
                                                                    <label for="money{{ $exp->id }}">Summasi</label>
                                                                    <input type="number" class="form-control" name="money" id="money{{ $exp->id }}" value="{{ $exp->money }}" required>
                                                                    <div class="valid-feedback text-danger">
                                                                        Narxni kiriting !
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mt-2">
                                                                    <div class="form-group">
                                                                        <label for="cost_id{{ $exp->id }}">Harajat turi</label>
                                                                        <select name="cost_id" class="form-control" id="cost_id{{ $exp->id }}" required>
                                                                            <option value="">---</option>
                                                                            @foreach($costs as $c)
                                                                                <option @if($c->id == $exp->cost_id) selected @endif value="{{ $c->id }}">{{ $c->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="valid-feedback text-danger">
                                                                        Harajat turini tanlang!
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

                                        <button type="button" data-url="{{ route('expense.destroy', [$exp->id]) }}" data-name="{{ $exp->name }}" class="btn btn-danger js_delete_btn btn-square btn-sm" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
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
