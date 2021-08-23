@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card students">

            <div class="card-body" style="position: relative;">
                <a href="" class="btn btn-square btn-primary" data-toggle="modal" data-target="#add-model" style="position: absolute; z-index: 1;">Qo'shish</a>

                {{-- Add Modal--}}
                @include('cost.addModal')

                <table id="datatableCost" class="display bg-info" style="width:100%;">
                    <thead>
                    <tr>
                        <th width="6%">№</th>
                        <th>Nomi</th>>
                        <th width="15%" class="text-right">Harakatlar</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($costs as $c)
                    <tr class="js_this_tr" data-id="{{ $c->id }}">
                        <td class="text-center">{{ ++$loop->index }}</td>
                        <td>{{ $c->name }}</td>

                        <td class="text-right">
                            <div class="btn-group js_btn_group" role="group" aria-label="Basic example">
                                <a href="" class="js_edit_btn btn btn-info btn-square btn-sm" title="Тахрирлаш" data-toggle="modal" data-target="#edit{{ $c->id }}">
                                    <svg class="c-icon c-icon-lg">
                                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                    </svg>
                                </a>
                                {{-- Edit Modal--}}
                                @include('cost.editModal')

                                <button type="button" data-url="{{ route('cost.destroy', [$c->id]) }}" data-name="{{ $c->name }}" class="btn btn-danger js_delete_btn btn-square btn-sm" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
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

            $('#datatableCost').DataTable({
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

            /** Cost add & edit **/
            $('.js_cost_modal_form').on('submit', function(e) {
                e.preventDefault()

                let url     = $(this).attr('action')
                let method  = $(this).attr('method')
                let name_error  = $(this).find('.name_error')

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

            $('.js_cost_modal_form input[name="name"]').on('keyup', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.name_error').addClass('valid-feedback')
            })

        });
    </script>
@endsection
