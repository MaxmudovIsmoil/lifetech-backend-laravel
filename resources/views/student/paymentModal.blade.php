<div class="modal fade" id="payment{{ $s['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="payment-model-Lavel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="payment-model-Lavel">{{ $s['lastname']." ".$s['firstname'].' to\'lovlari' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left pb-0 pt-2">
                <select name="student_active_group" class="form-control js_student_active_group mb-3"></select>
                <div class="div-student-payments">
                    <table class="table table-striped table-bordered js_student_payment_table">
                        <thead class="student-payments-thead">
                            <tr>
                                <th class="text-center">Oy</th>
                                <th class="text-center">Sana</th>
                                <th class="text-center">To'lov</th>
                                <th class="text-center">Chegirma</th>
                                <th class="text-center">To'langan</th>
                                <th class="text-center">Qarzdorlik</th>
                                <th class="text-center">
                                    <svg class="c-icon c-icon-lg">
                                        <use xlink:href="{{ asset('/icons/sprites/free.svg#cil-options') }}"></use>
                                    </svg>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="js_student_payment_table_tbody"></tbody>
                    </table>
                </div>
                <hr class="mt-0 mb-2">
                <p class="mb-1">To'lov qilish</p>
                <form method="post" action="{{ route('student.student_payment', [$s['id']]) }}" data-student_id="{{ $s['id'] }}" class="form-group js_student_payment_in_group_form_modal d-flex justify-content-between mb-1">
                    @csrf
                    <input type="hidden" name="group_id" class="js_group_id" value="">
                    <input type="hidden" name="total" class="js_total" value="">
                    <input type="hidden" name="last_payment_id" class="js_last_payment_id" value="">
                    <input type="hidden" name="last_lend" class="js_last_lend" value="">
                    <input type="hidden" name="td_last_month" class="js_td_last_month" value="">
                    <div class="form-group mb-1">
                        <select class="form-control js_student_payment_month" name="month"></select>
                    </div>

                    <div class="form-group mb-1">
                        <input type="number" name="paid" class="form-control paid" min="0" max="" placeholder="Summani kiriting!" required>
                        <div class="valid-feedback paid-error text-danger">
                            Summani kiriting!
                        </div>
                    </div>
                    <div class="form-group mb-1">
                        <select class="form-control payment_type" name="payment_type">
                            <option value="1">Naqt</option>
                            <option value="2">Plastic</option>
                            <option value="3">Click</option>
                        </select>
                    </div>
                    <div class="form-group mb-1">
                        <select class="form-control discount_type" name="discount_type">
                            <option value="0">Chegirma</option>
                            <option value="1">so'm</option>
                            <option value="2">foiz</option>
                        </select>
                    </div>
                    <div class="form-group mb-1">
                        <input type="number" name="discount_val" class="form-control discount_val d-none" value="" placeholder="Chegirmani kiriting!">
                        <div class="valid-feedback discount-val-error text-danger">
                            Chegirmani kiriting!
                        </div>
                    </div>

                    <div class="form-group mb-1">
                        <button type="submit" class="btn btn-success btn-block">Saqlash</button>
                    </div>
                </form>
                <p class="text-danger text-center js_msg mb-1"></p>
            </div>
            <div class="modal-footer mt-0">
                <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Bekor qilish</button>
            </div>
        </div>
    </div>
</div>
