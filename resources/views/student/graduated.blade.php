@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card students">
                <div class="btn-group btn-square mb-0">
                    <a href="{{ route('student.newcomers') }}"  class="btn btn-square btn-secondary">Yangi kelganlar <span class="badge badge-info">{{ $students_count['new'] }}</span></a>
                    <a href="{{ route('student.study') }}"      class="btn btn-square btn-secondary">O'qiyotganlar <span class="badge badge-info">{{ $students_count['study'] }}</span></a>
                    <a href="{{ route('student.graduated') }}"  class="btn btn-square btn-primary">Bitirganlar <span class="badge badge-info">{{ $students_count['graduated'] }}</span></a>
                    <a href="{{ route('student.uneducated') }}" class="btn btn-square btn-secondary">O'qimaganlar <span class="badge badge-info">{{ $students_count['uneducated'] }}</span></a>
                </div>
                <div class="card-body" style="position: relative; padding-top: 10px;">
                    <table id="datatableGraduated" class="display bg-info" style="width:100%;">
                        <thead>
                        <tr>
                            <th width="4%">№</th>
                            <th>Ism</th>
                            <th>Familiya</th>
                            <th width="13%">Telefon</th>
{{--                            <th>Kurs</th>--}}
                            <th>Guruh</th>
                            <th width="15%">Kelgan sana</th>
                            <th width="8%" class="text-right">Harakatlar</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    {{-- Edit modal --}}
                    @include('student.editModal')

                    {{-- Show modal --}}
                    @include('student.showModal')
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/jquery.maskedinput.min.js') }}"></script>
    <script>
        function inArray(needle, haystack) {
            var length = haystack.length;
            for(var i = 0; i < length; i++) {
                if(haystack[i] == needle) return true;
            }
            return false;
        }

        $(document).ready(function() {

            var tableGraduated = $('#datatableGraduated').DataTable({
                paging: true,
                pageLength: 20,
                lengthChange: false,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                language: {
                    search: "",
                    searchPlaceholder: " Izlash...",
                    sLengthMenu: "Кўриш _MENU_ тадан",
                    sInfo: "Ko'rish _START_ dan _END_ gacha _TOTAL_ jami",
                    emptyTable: "Ma'lumot mavjud emas",
                    sInfoFiltered: "(Jami _MAX_ ta yozuvdan filtrlangan)",
                    sZeroRecords: "Hech qanday mos yozuvlar topilmadi",
                    oPaginate: {
                        sNext: "Keyingi",
                        sPrevious: "Oldingi",
                    },
                },
                processing: true,
                serverSide: true,
                ajax: '{{ route("student.getGraduated") }}',
                columns: [
                    {data: 'number'},
                    {data: 'firstname'},
                    {data: 'lastname'},
                    {data: 'phone'},
                    // {data: 'course_ids'},
                    {data: 'group'},
                    {data: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            tableGraduated.on( 'draw', function () {
                $('tr td:nth-child(1)').each(function (){
                    $(this).addClass('text-center')
                })
            });
            tableGraduated.on( 'draw', function () {
                $('tr td:nth-child(4)').each(function (){
                    var l = $(this).text().length
                    var str = $(this).text().substr(4, l)
                    $(this).text(str)
                })
            });
            tableGraduated.on( 'draw', function () {
                $('tr td:nth-child(7)').each(function (){
                    $(this).addClass('text-right')
                })
            });

            /** Student add and edit modal from **/
            $('.js_modal_student_form').on('submit', function(e) {
                e.preventDefault()

                var modal = $('.modal')
                let url = $(this).attr('action')
                let method = $(this).attr('method')
                let firstname_error = $(this).find('.firstname_error')
                let lastname_error  = $(this).find('.lastname_error')
                let phone_error     = $(this).find('.phone_error')
                let address_error   = $(this).find('.address_error')
                let born_error      = $(this).find('.born_error')
                let company_error   = $(this).find('.company_error')
                let advertising_error = $(this).find('.advertising_error')

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
                            if (response.errors.advertising) {
                                advertising_error.removeClass('valid-feedback')
                                advertising_error.siblings('select[name="advertising"]').addClass('is-invalid')
                            }

                            if (response.errors.course) {
                                course_error.removeClass('valid-feedback')
                            }
                        }
                        if (response.success) {
                            tableGraduated.draw()
                            modal.modal('hide')
                        }
                    },
                    error: (response) => {
                        console.log(response)
                    }
                });

            });

            /** Student edit **/
            $(document).on('click', '.js_edit_btn', function () {
                var url = $(this).attr('href')
                var editModal = $('#editModal')
                var form = $("#js_modal_student_edit_form")
                var action = $(this).data('action')
                form.attr('action', action)

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: "json",
                    // data: {},
                    success: (response) => {
                        console.log(response)
                        $('#edit_firstname').val(response.student.firstname)
                        $('#edit_lastname').val(response.student.lastname)

                        var length = (response.student.phone).length
                        var phone = (response.student.phone).substr(4, length)
                        $('#edit_phone').val(phone)

                        $('#edit_phone2').val(response.student.phone2)
                        $('#edit_address').val(response.student.address)
                        $('#edit_born').val(response.student.born)
                        $('#edit_company').val(response.student.company)

                        var gender_male = $('#edit_gender1')
                        if(gender_male.val() == response.student.gender) {
                            gender_male.attr('checked', 'true')
                        }

                        var gender_female = $('#edit_gender2')
                        if(gender_female.val() == response.student.gender) {
                            gender_female.attr('checked', 'true')
                        }

                        var advertising = $("#edit_advertising option")
                        $.each( advertising, function( key, value ) {
                            if($(value).val() == response.student.advertising) {
                                $(value).attr('selected', 'true')
                            }
                        })

                        var status = $("#edit_status option")
                        $.each( status, function( key, value ) {
                            if($(value).val() == response.student.status) {
                                $(value).attr('selected', 'true')
                            }
                        })

                        var course_ids = (response.student.course_ids).split(';')
                        var course_inputs = editModal.find('.course_inputs')
                        $.each(course_inputs, function(key, input) {
                            if(inArray($(input).val(), course_ids)) {
                                $(input).attr('checked', 'true')
                            }
                        })
                    },
                    error: (response) => {
                        console.log('error:', response)
                    }
                })
            })

            /** Student show **/
            $(document).on('click', '.js_show_btn', function (e) {
                e.preventDefault()
                var url = $(this).attr('href')
                var tableStudentShow = $('#tableStudentShow')
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: "json",
                    // data: {},
                    success: (response) => {
                        tableStudentShow.find('.firstname').html(response[0].firstname)
                        tableStudentShow.find('.lastname').html(response[0].lastname)
                        tableStudentShow.find('.born').html(response[0].born)
                        tableStudentShow.find('.phone').html(response[0].phone)
                        tableStudentShow.find('.phone2').html(response[0].phone2)
                        tableStudentShow.find('.address').html(response[0].address)
                        if(response[0].gender)
                            tableStudentShow.find('.gender').html('Erkak')
                        else
                            tableStudentShow.find('.gender').html('Ayol')

                        tableStudentShow.find('.company').html(response[0].company)
                        tableStudentShow.find('.advertising').html(response[0].advertising)
                        tableStudentShow.find('.course_ids').html(response[0].course_ids)
                        tableStudentShow.find('.created_at').html(response[0].created_at)
                    },
                    error: (response) => {
                        console.log('error:', response)
                    }
                })
            })
        });
    </script>
    <script src="{{ asset('js/functionStudent.js') }}"></script>
@endsection
