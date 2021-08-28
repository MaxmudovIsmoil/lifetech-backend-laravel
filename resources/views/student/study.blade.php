@extends('layouts.app')

@section('style')
    <style>
        #datatablePaymentsStudent tr > td:first-child {
            width: 2% !important;
        }
        #datatablePaymentsStudent tr > td:nth-child(2) {
            width: 24% !important;
        }
        #datatablePaymentsStudent tr > td:nth-child(5) {
            font-weight: 600 !important;
        }
        #datatablePaymentsStudent tr > td:nth-child(6) {
            color: red !important;
        }
        #datatablePaymentsStudent tr > td:last-child {
            width: 2% !important;
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card students">
                <div class="btn-group btn-square">
                    <a href="{{ route('student.newcomers') }}"  class="btn btn-square btn-secondary">Yangi kelganlar <span class="badge badge-info">{{ $students_count['new'] }}</span></a>
                    <a href="{{ route('student.study') }}"      class="btn btn-square btn-primary">O'qiyotganlar <span class="badge badge-info">{{ $students_count['study'] }}</span></a>
                    <a href="{{ route('student.graduated') }}"  class="btn btn-square btn-secondary">Bitirganlar <span class="badge badge-info">{{ $students_count['graduated'] }}</span></a>
                    <a href="{{ route('student.uneducated') }}" class="btn btn-square btn-secondary">O'qimaganlar <span class="badge badge-info">{{ $students_count['uneducated'] }}</span></a>
                </div>

                <div class="card-body" style="position: relative; padding-top: 10px;">
                    <table id="datatableStudy" class="display bg-info" style="width:100%;">
                        <thead>
                        <tr>
                            <th width="4%">№</th>
                            <th>Ism</th>
                            <th>Familiya</th>
                            <th width="13%">Telefon</th>
                            <th>Kurs</th>
                            <th width="12%">Guruh</th>
                            <th width="15%">Sana</th>
                            <th width="5%" class="text-right">Harakatlar</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    {{-- Edit modal --}}
                    @include('student.editModal')

                    {{-- Show modal --}}
                    @include('student.showModal')

                    {{--- Payment modal --}}
                    @include('student.paymentModal')
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

        function create_payment_datatable(url, student_id, group_id)
        {
            var modal = $(document).find('#paymentModal');
            var payment_table = modal.find('#datatablePaymentsStudent');

            return payment_table.DataTable({
                processing: false,
                serverSide: false,
                paging: false,
                lengthChange: false,
                searching: false,
                ordering: false,
                info: false,
                autoWidth: true,
                language: {
                    emptyTable: "To'lov mavjud emas",
                },
                ajax: {
                    "url": url,
                    "data": { 'student_id': student_id, 'group_id': group_id }
                },
                columns: [
                    {data: 'month', name: 'month', className: 'text-center'},
                    {data: 'created_at', name: 'created_at', className: 'text-center'},
                    {data: 'total', name: 'total', className: 'text-center', render: $.fn.dataTable.render.number(' ', '.', 0, '')},
                    {data: 'discount', name: 'discount', className: 'text-center', render: $.fn.dataTable.render.number(' ', '.', 0, '')},
                    {data: 'paid', name: 'paid', className: 'text-center', render: $.fn.dataTable.render.number(' ', '.', 0, '')},
                    {data: 'debt', name: 'debt', className: 'text-center', render: $.fn.dataTable.render.number(' ', '.', 0, '')},
                    {data: 'action', name: 'action', className: 'text-center'}
                ]
            });
        }


        $(document).ready(function() {

            var tableStudy = $('#datatableStudy').DataTable({
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
                ajax: {
                    "url": '{{ route("student.getStudy") }}',
                },
                columns: [
                    {data: 'number'},
                    {data: 'firstname'},
                    {data: 'lastname'},
                    {data: 'phone'},
                    {data: 'course_ids'},
                    {data: 'group'},
                    {data: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            tableStudy.on( 'draw', function () {
                $('tr td:nth-child(1)').each(function (){
                    $(this).addClass('text-center')
                })
            });
            tableStudy.on( 'draw', function () {
                $('tr td:nth-child(4)').each(function (){
                    var l = $(this).text().length
                    var str = $(this).text().substr(4, l)
                    $(this).text(str)
                })
            });
            tableStudy.on( 'draw', function () {
                $('tr td:nth-child(5)').each(function (){
                    var l = $(this).text().length-2
                    var str = $(this).text().substr(0, l)
                    $(this).text(str)
                })
            });
            tableStudy.on( 'draw', function () {
                $('tr td:nth-child(8)').each(function (){
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
                            // location.reload()
                            tableStudy.draw()
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


            /** ================================== Payments ================================= **/

            var modal = $(document).find('#paymentModal');
            var payment_table = modal.find('#datatablePaymentsStudent');

            $(document).on('click', '.js_payment_btn', function(e) {
                e.preventDefault()

                var fullName = $(this).data('fullName')
                modal.find('.modal-title').html(fullName+" to'lovlari")

                var url = $(this).attr('href')
                var student_id = $(this).data('studentId')
                var group_id = $(this).data('groupId')

                create_payment_datatable(url, student_id, group_id)

                /** Forma uchun student_id, group_id, month, total larni qo'shish **/
                var form = $(document).find('#js_pay_form_modal')
                form.find("input[name='student_id']").val(student_id)
                form.find('input[name="group_id"]').val(group_id)
                var option = '<option>---</option>';

                $.ajax({
                    type: 'GET',
                    url: '{{ route("studentPayment.get_months_price") }}',
                    data: { 'group_id': group_id },
                    success: (response) => {
                        console.log(response)
                        form.find('input[name="total"]').val(response[0].price)
                        form.find('input[name="paid"]').attr('max', response[0].price)
                        for( var i = 1; i <= response[0].month; i++ ) {
                            option += '<option value="'+i+'">'+i+' - oy</option>';
                        }
                        form.find('#js_student_payment_month').html(option)
                    },
                    error: (response) => {
                        console.log('error: ', response)
                    }
                })
                modal.modal('show')
            });

            $('#paymentModal button[data-dismiss="modal"]').click(function () {
                var payment_table = modal.find('#datatablePaymentsStudent').DataTable();
                payment_table.destroy();
            });


            $('#js_student_payment_month').on('change', function() {

                var this_val = $(this).val()
                var modal = $(document).find('#paymentModal');
                var table_tbody_tr = $('#datatablePaymentsStudent tr')
                var paid = modal.find('.paid')

                var payment_id = modal.find('.js_payment_id')
                var lend = modal.find('.js_lend')
                var total = modal.find('input[name="total"]').val()

                var t = true;
                $.each(table_tbody_tr, function (key, tr) {

                    if (this_val == $(tr).data('month')) {
                        var qarz = $(tr).data('qarz')
                        paid.attr('max', qarz)
                        payment_id.val($(tr).data('payment_id'))
                        lend.val(qarz)
                    }
                    else if(this_val > $(tr).data('month')){
                        paid.attr('max', total)
                    }

                })
            })

            $('.discount_type').on('change', function(e) {
                let this_dis_type_val = $(this).val();
                let form = $(this).closest('#js_pay_form_modal');
                let discount_val = form.find('.discount_val');

                if((this_dis_type_val == 1) || (this_dis_type_val == 2))
                    discount_val.removeClass('d-none')
                else
                    discount_val.addClass('d-none')
            });


            $(document).on('submit', '#js_pay_form_modal', function(e) {
                e.preventDefault()

                var table_pay = $('#datatablePaymentsStudent').DataTable()
                var url = $(this).attr('action')

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $(this).serialize(),
                    success: (response) => {
                        console.log(response)

                        if(response.success) {
                            location.reload()
                        }
                    },
                    error: (response) => {
                        console.log('error: ', response)
                    }

                })
            });


            /** modaldagi o'chirish tugmachasi trash **/
            $(document).on('click', '.js_payment_delete_btn', function(e){
                e.preventDefault()
                var url = $(this).attr('href')
                var delete_modal = $('#payment_delete_modal')
                $('#js_student_payment_delete_modal_form').attr('action', url)
                delete_modal.modal('show')
            })

            $(document).on('submit', '#js_student_payment_delete_modal_form', function(e) {
                e.preventDefault()
                var delete_modal = $('#payment_delete_modal')
                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: (response) => {

                        var payment_table_tr = modal.find('#datatablePaymentsStudent tr');

                        $.each(payment_table_tr, function (key, tr) {

                            var paymentId = $(tr).data('payment_id')

                            if(paymentId == response.payment_id) {
                                $(tr).remove()
                            }
                        })
                        delete_modal.modal('hide')

                    },
                    error: (response) => {
                        console.log('error: ', response)
                    }
                })

            })
        });
    </script>

{{--    <script src="{{ asset('js/functionStudent.js') }}"></script>--}}
@endsection
