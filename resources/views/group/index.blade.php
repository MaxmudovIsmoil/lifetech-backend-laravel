@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}">
@endsection

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
                                    <div class="dropdown d-inline-block">
                                        <svg class="c-icon c-icon-lg" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-options') }}"></use>
                                        </svg>
                                        <div class="dropdown-menu pt-0 pb-0" aria-labelledby="dropdownMenuButton">
                                            <a href="" class="dropdown-item js_edit_btn" data-toggle="modal" data-target="#showStudent{{ $g['id'] }}">
                                                <svg class="c-icon c-icon-md mr-2">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-people') }}"></use>
                                                </svg> O'quvchilar
                                            </a>

                                            @if(Request::segment(2) == '1' || Request::segment(2) == '2')
                                                <a href="" class="dropdown-item js_edit_btn" data-toggle="modal" data-target="#addStudent{{ $g['id'] }}">
                                                    <svg class="c-icon c-icon-md mr-2">
                                                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-user-follow') }}"></use>
                                                    </svg> Student qo'shish
                                                </a>
                                            @endif

                                            <a href="" class="dropdown-item js_edit_btn" data-toggle="modal" data-target="#edit{{ $g['id'] }}">
                                                <svg class="c-icon c-icon-md mr-2">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                                </svg> Tahrirlash
                                            </a>

                                            <button type="button" data-url="{{ route('group.destroy', [$g['id']]) }}" data-name="{{ $g['name'] }}" class="dropdown-item js_delete_btn" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                                <svg class="c-icon c-icon-md mr-2">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-trash') }}"></use>
                                                </svg> O'chirish
                                            </button>
                                        </div>
                                    </div>
                                    {{-- Students in group --}}
                                    @include('group.showStudents')

                                    @if(Request::segment(2) == '1' || Request::segment(2) == '2')
                                        {{-- Student add in group Modal --}}
                                        @include('group.addStudent')
                                    @endif

                                    {{-- Edit Modal--}}
                                    @include('group.editModal')
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
    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('#datatableGroup').DataTable({
                paging: false,
                pageLength: 20,
                lengthChange: true,
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

            /** Group add & edit **/
            $('.js_modal_group_form').on('submit', function (e) {
                e.preventDefault()

                let url = $(this).attr('action')
                let method = $(this).attr('method')
                let course_id_error = $(this).find('.course_id_error')
                let teacher_id_error = $(this).find('.teacher_id_error')
                let name_error = $(this).find('.name_error')
                let time_error = $(this).find('.time_error')
                let type_error = $(this).find('.type_error')

                let days_error = $(this).find('.days_error')

                $.ajax({
                    url: url,
                    type: method,
                    dataType: "json",
                    data: $(this).serialize(),
                    success: (response) => {
                        console.log(response)
                        if (response.success == false) {
                            if (response.errors.course_id) {
                                course_id_error.removeClass('valid-feedback')
                                course_id_error.siblings('select[name="course_id"]').addClass('is-invalid')
                            }
                            if (response.errors.teacher_id) {
                                teacher_id_error.removeClass('valid-feedback')
                                teacher_id_error.siblings('select[name="teacher_id"]').addClass('is-invalid')
                            }
                            if (response.errors.name) {
                                name_error.removeClass('valid-feedback')
                                name_error.siblings('input[name="name"]').addClass('is-invalid')
                            }
                            if (response.errors.address) {
                                address_error.removeClass('valid-feedback')
                                address_error.siblings('input[name="address"]').addClass('is-invalid')
                            }
                            if (response.errors.time) {
                                time_error.removeClass('valid-feedback')
                                time_error.siblings('input[name="time"]').addClass('is-invalid')
                            }

                            if (response.errors.type) {
                                type_error.removeClass('valid-feedback')
                                type_error.siblings('select[name="type"]').addClass('is-invalid')
                            }


                            if (response.errors.days) {
                                days_error.removeClass('valid-feedback')
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

            $('.js_modal_group_form select[name="course_id"]').on('change', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.course_id_error').addClass('valid-feedback')
            })

            $('.js_modal_group_form select[name="teacher_id"]').on('change', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.teacher_id_error').addClass('valid-feedback')
            })

            $('.js_modal_group_form input[name="name"]').on('keyup', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.name_error').addClass('valid-feedback')
            })

            $('.js_modal_group_form input[name="time"]').on('change', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.time_error').addClass('valid-feedback')
            })

            $('.students_ingroup').multiSelect({
                afterSelect: (values) => {
                    let modal = $(document).find('#student_in_group_model')
                    modal.modal('show')
                    setTimeout(function () {
                        modal.modal('hide');
                    }, 6000);
                },
                afterDeselect: (values) => {
                    let modal = $(document).find('#student_out_group_model')
                    modal.modal('show')
                    setTimeout(function () {
                        modal.modal('hide');
                    }, 6000);
                }
            })

            /***
             * add Student in group and update
             * **/
            $('.js_add_student_group_modal_from').on('submit', function (e) {
                e.preventDefault()
                let url = $(this).attr('action')
                let formData = new FormData(this);

                let modal = $(this).closest('.modal');

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: "json",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        modal.modal('hide')
                        console.log(1111)
                    },
                    error: (response) => {
                        console.log(response)
                    }
                });
            });

        });
    </script>
@endsection
