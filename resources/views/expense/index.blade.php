@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card students">
                @isset($costs)
                    <div class="btn-group btn-square js_expense_btn">
                        @foreach($costs as $c)
                            <a href="{{ route('expense.index', ['cost_type' => $c->id]) }}" class="btn btn-square @if(Request::segment(2) == $c->id) btn-primary @else btn-secondary @endif">{{ $c->name }}</a>
                        @endforeach
                    </div>
                @endisset
                <div class="card-body" style="position: relative;">
                    <a href="" class="btn btn-square btn-primary" data-toggle="modal" data-target="#add-model" style="position: absolute; z-index: 1;">Qo'shish</a>

                    {{-- Add Modal--}}
                    @include('expense.addModal')

                    <table id="datatableExpense" class="display bg-info" style="width:100%;">
                        <thead>
                            <tr>
                                <th width="6%">№</th>
                                <th>Nomi</th>
                                <th>Summasi</th>
{{--                                <th>Harajat turi</th>--}}
                                <th>Harajat vaqti</th>
                                <th width="15%" class="text-right">Harakatlar</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($expense as $exp)
                            <tr class="js_this_tr" data-id="{{ $exp->id }}">
                                <td class="text-center">{{ ++$loop->index }}</td>
                                <td>{{ $exp->name }}</td>
                                <td>{{ number_format($exp->money, 0, '.', ' ') }}</td>
{{--                                <td>{{ $exp->cname }}</td>--}}
                                <td>{{ date("d.m.Y H : i", strtotime($exp->created_at)) }}</td>
                                <td class="text-right">
                                    <div class="btn-group js_btn_group" role="group" aria-label="Basic example">
                                        <a href="" class="js_edit_btn btn btn-info btn-square btn-sm" title="Тахрирлаш" data-toggle="modal" data-target="#edit{{ $exp->id }}">
                                            <svg class="c-icon c-icon-lg">
                                                <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                            </svg>
                                        </a>
                                        {{-- Edit Modal--}}
                                        @include('expense.editModal')

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
