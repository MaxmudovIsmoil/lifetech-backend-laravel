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

@section('script')
    <script>
        $(document).ready(function () {

            $('#datatableExpense').DataTable({
                paging: true,
                pageLength: 10,
                lengthChange: false,
                searching: true,
                ordering: true,
                info: false,
                autoWidth: false,
                language: {
                    search: "",
                    searchPlaceholder: " Izlash...",
                    sLengthMenu: "Кўриш _MENU_ тадан",
                    sInfo: "Ko'rish _START_ dan _END_ gacha _TOTAL_ jami",
                    emptyTable: "Ma'lumot mavjud emas",
                }
            });

            /** Expense add & edit **/
            $('.js_expense_modal_form').on('submit', function (e) {
                e.preventDefault()

                let url = $(this).attr('action')
                let method = $(this).attr('method')
                let name_error = $(this).find('.name_error')
                let money_error = $(this).find('.money_error')
                let cost_id_error = $(this).find('.cost_id_error')

                $.ajax({
                    url: url,
                    type: method,
                    dataType: "json",
                    data: $(this).serialize(),
                    success: (response) => {
                        console.log(response)
                        if (response.success == false) {

                            if (response.errors.name) {
                                name_error.removeClass('valid-feedback')
                                name_error.siblings('input[name="name"]').addClass('is-invalid')
                            }
                            if (response.errors.money) {
                                money_error.removeClass('valid-feedback')
                                money_error.siblings('input[name="money"]').addClass('is-invalid')
                            }
                            if (response.errors.cost_id) {
                                cost_id_error.removeClass('valid-feedback')
                                cost_id_error.siblings('select[name="cost_id"]').addClass('is-invalid')
                            }

                        }
                        if (response.success) {
                            location.reload()
                        }
                    },
                    error: (response) => {
                        console.log(response)
                    }
                });

            });

            $('.js_expense_modal_form input[name="name"]').on('keyup', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.name_error').addClass('valid-feedback')
            })

            $('.js_expense_modal_form input[name="money"]').on('keyup', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.money_error').addClass('valid-feedback')
            })

            $('.js_expense_modal_form select[name="cost_id"]').on('change', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.cost_id_error').addClass('valid-feedback')
            })

            /** expense category btn first add active **/
            let pathExpense = window.location.pathname + window.location.search
            if (pathExpense == '/expense/0') {
                $('.js_expense_btn .btn').first().removeClass('btn-secondary')
                $('.js_expense_btn .btn').first().addClass('btn-primary')
            }
        })

    </script>
@endsection
