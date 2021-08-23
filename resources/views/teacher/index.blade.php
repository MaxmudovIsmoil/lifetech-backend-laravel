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
                                    <div class="dropdown d-inline-block">
                                        <svg class="c-icon c-icon-lg" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-options') }}"></use>
                                        </svg>
                                        <div class="dropdown-menu pt-0 pb-0" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ route('student.show', [$t['id']]) }}" class="dropdown-item js_show_student" data-toggle="modal" data-target="#show{{ $t['id'] }}">
                                                <svg class="c-icon c-icon-md mr-2">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-low-vision') }}"></use>
                                                </svg> To'liq ko'rish
                                            </a>
                                            <a href="" class="dropdown-item js_edit_btn" data-toggle="modal" data-target="#edit{{ $t['id'] }}">
                                                <svg class="c-icon c-icon-md mr-2">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-color-border') }}"></use>
                                                </svg> Tahrirlash
                                            </a>
                                            <button type="button" data-url="{{ route('teacher.destroy', [$t['id']]) }}" data-name="{{ $t['firstname'] }}" class="dropdown-item js_delete_btn" title="O'chirish" data-toggle="modal" data-target="#delete_notify">
                                                <svg class="c-icon c-icon-lg">
                                                    <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-trash') }}"></use>
                                                </svg> O'chirish
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Show Modal--}}
                                    @include('teacher.showModal')
                                    {{-- Edit Modal--}}
                                    @include('teacher.editModal')

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
    <script src="{{ asset('js/functionTeacher.js') }}"></script>
    <script src="{{ asset('js/jquery.maskedinput.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            /** Teacher add & edit **/
            $('.js_modal_teacher_form').on('submit', function (e) {
                e.preventDefault()

                let url = $(this).attr('action')
                let method = $(this).attr('method')
                let firstname_error = $(this).find('.firstname_error')
                let lastname_error = $(this).find('.lastname_error')
                let phone_error = $(this).find('.phone_error')
                let address_error = $(this).find('.address_error')
                let born_error = $(this).find('.born_error')
                let company_error = $(this).find('.company_error')
                let username_error = $(this).find('.username_error')
                let password_error = $(this).find('.password_error')
                let password_confirm_error = $(this).find('.password_confirm_error')

                let course_error = $(this).find('.course_error')
                $.ajax({
                    url: url,
                    type: method,
                    dataType: "json",
                    data: $(this).serialize(),
                    success: (response) => {
                        console.log(response)
                        if (response.success == false) {
                            if (response.errors.firstname) {
                                firstname_error.removeClass('valid-feedback')
                                firstname_error.siblings('input[name="firstname"]').addClass('is-invalid')
                            }
                            if (response.errors.lastname) {
                                lastname_error.removeClass('valid-feedback')
                                lastname_error.siblings('input[name="lastname"]').addClass('is-invalid')
                            }
                            if (response.errors.phone) {
                                phone_error.removeClass('valid-feedback')
                                phone_error.siblings('input[name="phone"]').addClass('is-invalid')
                            }
                            if (response.errors.address) {
                                address_error.removeClass('valid-feedback')
                                address_error.siblings('input[name="address"]').addClass('is-invalid')
                            }
                            if (response.errors.born) {
                                born_error.removeClass('valid-feedback')
                                born_error.siblings('input[name="born"]').addClass('is-invalid')
                            }

                            if (response.errors.company) {
                                company_error.removeClass('valid-feedback')
                                company_error.siblings('input[name="company"]').addClass('is-invalid')
                            }
                            if (response.errors.username) {
                                username_error.removeClass('valid-feedback')
                                username_error.siblings('input[name="username"]').addClass('is-invalid')
                            }

                            if (response.errors.password) {
                                password_error.removeClass('valid-feedback')
                                password_error.siblings('input[name="password"]').addClass('is-invalid')
                            }
                            if (response.errors.password_confirm) {
                                password_confirm_error.removeClass('valid-feedback')
                                password_confirm_error.siblings('input[name="password_confirm"]').addClass('is-invalid')
                            }

                            if (response.errors.course) {
                                course_error.removeClass('valid-feedback')
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

            $('.js_modal_teacher_form input[name="firstname"]').on('keyup', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.firstname_error').addClass('valid-feedback')
            })

            $('.js_modal_teacher_form input[name="lastname"]').on('keyup', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.lastname_error').addClass('valid-feedback')
            })

            $('.js_modal_teacher_form input[name="phone"]').on('keyup', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.phone_error').addClass('valid-feedback')
            })

            $('.js_modal_teacher_form input[name="address"]').on('keyup', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.address_error').addClass('valid-feedback')
            })

            $('.js_modal_teacher_form input[name="born"]').on('change', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.born_error').addClass('valid-feedback')
            })

            $('.js_modal_teacher_form input[name="company"]').on('keyup', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.company_error').addClass('valid-feedback')
            })

            $('.js_modal_teacher_form input[name="username"]').on('keyup', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.username_error').addClass('valid-feedback')
            })

            $('.js_modal_teacher_form input[name="password"]').on('keyup', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.password_error').addClass('valid-feedback')
            })

            $('.js_modal_teacher_form input[name="password_confirm"]').on('keyup', function () {
                $(this).removeClass('is-invalid')
                $(this).siblings('.password_confirm_error').addClass('valid-feedback')
            })
        });
    </script>
@endsection
