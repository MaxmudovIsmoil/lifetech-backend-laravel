<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentDetalies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class StudentPaymentController extends Controller
{
    /** student courses **/
    public function get_student_groups($id)
    {
        $student_active_groups = DB::table('group_students AS gs')
            ->leftJoin('groups AS g', 'g.id' ,'=', 'gs.group_id')
            ->leftJoin('courses AS c', 'c.id' ,'=', 'g.course_id')
            ->leftJoin('users AS t', 't.id' ,'=', 'g.teacher_id')
            ->select('gs.student_id', 'c.name AS cname', 'g.id AS group_id', 'g.name AS gname', 't.lastname', 't.firstname')
            ->where('g.status', '2')
            ->where('gs.student_id', $id)
            ->get();

        return response()->json(['student_active_groups' => $student_active_groups]);
    }

    /**
     * Student guruhga to'lagan to'lovlari
     * @param Request $request
//     * @param $student_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function student_payments_in_group(Request $request)
    {
        $student_id = $request->student_id;
        $group_id = $request->group_id;

        $payment_detalies = DB::table('payment_detalies AS pd')
            ->select('pd.payment_id', DB::raw('SUM(pd.paid) AS paid'))
            ->groupBy('pd.payment_id');

        $payments = DB::table('payments As p')
            ->joinSub($payment_detalies, 'pd', function ($join) {
                $join->on('p.id', '=', 'pd.payment_id');
            })
            ->select('p.student_id', 'p.group_id', 'p.id As payment_id', 'p.month', DB::raw('DATE_FORMAT(p.created_at, "%d.%m.%Y %H:%i") as created_at'), 'p.total', 'p.discount', 'pd.paid')
            ->leftJoin('groups AS g', 'g.id' ,'=', 'p.group_id')
            ->leftJoin('courses AS c', 'c.id' ,'=', 'g.course_id')
            ->where('p.student_id', $student_id)
            ->where('p.group_id', $group_id)
            ->get();

        return Datatables::of($payments)
            ->addColumn('debt', function ($p) {
                $deb = $p->total - ($p->paid + $p->discount);
                return $deb;
            })
            ->addColumn('action', function ($p) {
                $now = strtotime("now");
                $next_day = strtotime("+1 day", strtotime($p->created_at));

                if ($now < $next_day) {
                    $btn = '<a href="'.route('studentPayment.payment_delete', [$p->payment_id]).'" style="color: darkred" class="js_payment_delete_btn">
                            <svg class="c-icon c-icon-md">
                                <use xlink:href="' . url("/icons/sprites/free.svg#cil-trash") . '"></use>
                            </svg>
                        </a>';
                    return $btn;
                }
            })
            ->setRowAttr([
                'data-payment_id' => '{{ $payment_id }}',
                'data-qarz'     => '{{ $debt }}',
                'data-month'    => '{{ $month }}',
            ])
//            ->editColumn('id', '{{$payment_id}}')
//            ->setRowClass('js_this_tr')
            ->make(true);

    }


    public function get_months_price(Request $request)
    {
        $group_id = $request->group_id;
        $course = DB::table('groups AS g')
            ->select('c.*')
            ->leftJoin('courses AS c', 'c.id', '=', 'g.course_id' )
            ->where('g.id', $group_id)
            ->first();

        return response()->json([$course]);
    }

    /**
     *  Payment qo'shish
     *  payment_id bo'lsa payment_detailes ga qo'shadi
     *  payment_id bo'lmasa payment, payment_detalies qo'shadi
     **/
    public function payment_student(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'month' => 'required',
            'paid'  => 'required',
            'payment_type'  => 'required',
            'discount_type'  => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->getMessageBag()->toArray()
            ]);
        }
        else {

            try {
                if ($request->discount_type == 0) // no discount
                    $discount = 0;
                elseif ($request->discount_type == 1) // cash
                    $discount = $request->discount_val;
                elseif($request->discount_type == 2) // plastic
                    $discount = $request->total * $request->discount_val * 0.01;

                if ($request->payment_id) {
                    // (qarz to'lash) payment_id bolsa payment_detailesno oziga qo'shadi

                    $payment_detailes = PaymentDetalies::create([
                        'payment_id' => $request->payment_id,
                        'paid' => $request->paid,
                        'payment_type' => $request->payment_type,
                    ]);
                }
                else {
                    // payment_id bolmasa paymentga, payment_detiles qo'shashi

                    $payment = Payment::create([
                        'group_id' => $request->group_id,
                        'student_id' => $request->student_id,
                        'total' => $request->total,
                        'month' => $request->month,
                        'discount' => $discount,
                        'discount_type' => $request->discount_type,
                        'discount_val' => ($request->discount_val) ? $request->discount_val : '',
                    ]);
                    $payment_id = $payment->id;

                    $payment_detailes = PaymentDetalies::create([
                        'payment_id' => $payment_id,
                        'paid' => $request->paid,
                        'payment_type' => $request->payment_type,
                    ]);
                }

                return response()->json(['success' => true]);
            }
            catch (\Exception $exception) {
                return response()->json([$exception]);
            }
        }
    }


    /**
     * Student payment and payment detalies delete
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     **/
    public function payment_delete($id)
    {
        PaymentDetalies::where('payment_id','=', $id)->delete();

        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json(['payment_id' => $id]);
    }


}
