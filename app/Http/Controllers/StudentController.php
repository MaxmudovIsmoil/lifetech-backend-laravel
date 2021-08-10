<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentDetalies;
use App\Models\User;
use App\Models\Course;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * closed
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->route('id');

        $student = DB::table('users')
                    ->where(array('utype' => 'student', 'status' => $id))
                    ->orderBy('created_at', 'DESC')
                    ->get();
        $i = 1;


        $advertising = DB::table('advertising')->get();

        $course = Course::all();

        $students = array();
        foreach($student as $k => $s) {

            $students[$k]['id'] = $s->id;
            $students[$k]['firstname'] = $s->firstname;
            $students[$k]['lastname'] = $s->lastname;
            $students[$k]['phone'] = $s->phone;
            $students[$k]['phone2'] = $s->phone2;
            $students[$k]['address'] = $s->address;
            $students[$k]['born'] = $s->born;
            $students[$k]['status'] = $s->status;
            $students[$k]['gender'] = $s->gender;
            $students[$k]['company'] = $s->company;
            $students[$k]['advertising'] = $s->advertising;
            $students[$k]['created_at'] = $s->created_at;
            $students[$k]['course_ids'] = explode(';', $s->course_ids);

        }

        return view('student.index', compact('students', 'course', 'i', 'advertising'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), $this->validateData());

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->getMessageBag()->toArray()
            ]);
        }
        else {
            $course_ids = '';
            $courses = Course::all();
            $t = false;
            foreach ($courses as $c) {
                if ($request->post('course_' . $c->id) == true) {
                    $course_ids .= $request->post('course_' . $c->id) . ";";
                    $t = true;
                }
            }
            if (!$t) {
                return response()->json([
                    'success' => false,
                    'errors' => ['course' => 'Kursni tanlneg']
                ]);
            }
            $course_ids = substr($course_ids, 0, -1);

            try {
                User::create([
                    'username'  => '',
                    'password'  => '',
                    'token'     => $request->_token,
                    'firstname' => $request->firstname,
                    'lastname'  => $request->lastname,
                    'phone'     => "+998" . $request->phone,
                    'phone2'    => isset($request->phone2) ? "+998" . $request->phone2 : '',
                    'address'   => $request->address,
                    'born'      => isset($request->born) ? $request->born : "",
                    'utype'     => "student",
                    'email'     => "student" . time() . "@gmail.com",
                    'status'    => '1',
                    'course_ids'=> $course_ids,
                    'gender'    => isset($request->gender) ? $request->gender : "",
                    'advertising'=>isset($request->advertising) ? $request->advertising : "",
                    'company'   => isset($request->company) ? $request->company : "",
                ]);
                return response()->json(['success' => true]);

            } catch (\Exception $exception) {
                return response()->json([
                    'success' => false,
                    'errors' => $exception
                ]);
            }
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validation = Validator::make($request->all(), $this->validateData());

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->getMessageBag()->toArray()
            ]);
        }
        else {
            $course_ids = '';
            $courses = Course::all();
            $t = false;
            foreach($courses as $c) {
                if($request->post('course_'.$c->id) == true){
                    $course_ids .= $request->post('course_'.$c->id).";";
                    $t = true;
                }
            }
            if (!$t) {
                return response()->json([
                    'success' => false,
                    'errors' => ['course' => 'Kursni tanlneg']
                ]);
            }
            $course_ids = substr($course_ids, 0, -1);

            $status = isset($request->status) ? $request->status : '1';
            try {
                $studentsOnce = User::findOrFail($id);
                $studentsOnce->fill([
                    'firstname' => $request->firstname,
                    'lastname'  => $request->lastname,
                    'phone'     => "+998".$request->phone,
                    'phone2'    => isset($request->phone2) ? "+998".$request->phone2 : '',
                    'address'   => $request->address,
                    'gender'    => $request->gender,
                    'born'      => isset($request->born) ? $request->born : '',
                    'status'    => $status,
                    'company'   => isset($request->company) ? $request->company : '',
                    'advertising'=> isset($request->advertising) ? $request->advertising : '',
                    'course_ids'=> $course_ids,
                ]);
                $studentsOnce->save();
                return response()->json(['success' => true]);
            }
            catch (\Exception $exception) {
                return response()->json([
                    'success' => false,
                    'errors' => $exception
                ]);
            }
        }
    }


    public function validateData()
    {
        return [
            'firstname' => 'required',
            'lastname'  => 'required',
            'phone'     => 'required',
            'address'   => 'required',
            'born'      => 'required',
            'company'   => 'required',
            'advertising' => 'required'
        ];
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $u = User::findOrFail($id);

        $u->delete();

        return response()->json(['id' => $id]);
    }


    public function student_active_groups($id)
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
     * @param $student_id
     * @param $group_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function student_payments_in_group($student_id, $group_id)
    {
        $student_payments = DB::table('payments AS p')
            ->leftJoin('groups AS g', 'g.id' ,'=', 'p.group_id')
            ->leftJoin('courses AS c', 'c.id' ,'=', 'g.course_id')
            ->select('c.name AS cname', 'c.price AS cprice', 'c.month AS cmonth', 'g.name AS gname', 'g.status AS gstatus', 'p.*')
            ->where('p.student_id', $student_id)
            ->where('p.group_id', $group_id)
            ->where('g.status','2')
            ->get();

        if ($student_payments->count() == 0) {
            $student_payments = DB::table('group_students AS gs')
                ->leftJoin('groups AS g', 'g.id' ,'=', 'gs.group_id')
                ->leftJoin('courses AS c', 'c.id' ,'=', 'g.course_id')
                ->select('c.name AS cname', 'c.price AS cprice', 'c.month AS cmonth', 'g.name AS gname', 'g.status AS gstatus')
                ->where('gs.student_id', $student_id)
                ->where('gs.group_id', $group_id)
                ->where('g.status','2')
                ->get();
        }

        $student_payment_detalies = DB::table('payments AS p')
            ->leftJoin('payment_detalies AS pd', 'pd.payment_id', '=','p.id')
            ->select( 'pd.payment_id', DB::raw('SUM(pd.paid) as paid'))
            ->groupBy('pd.payment_id')
            ->get();


        $student_payment_detalies_arr = array();
        foreach($student_payment_detalies as $val) {
            $student_payment_detalies_arr[$val->payment_id] = $val->paid;
        }

        return response()->json([
            'student_payments' => $student_payments,
            'student_payment_detalies_arr' => $student_payment_detalies_arr
        ]);
    }


    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function student_payment(Request $request, $id)
    {
        $validate = $request->validate([
            'month' => 'required',
            'paid'  => 'required',
        ]);

        if ($request->discount_type == 0) // no discount
            $discount = 0;
        elseif ($request->discount_type == 1) // cash
            $discount = $request->discount_val;
        elseif($request->discount_type == 2) // plastic
            $discount = $request->total * $request->discount_val * 0.01;


        try {
            if ($request->last_lend >= 0) {

                if ($request->td_last_month !== $request->month) {

                    $payment = Payment::create([
                        'group_id' => $request->group_id,
                        'student_id' => $id,
                        'total' => $request->total,
                        'month' => $request->month,
                        'discount' => $discount,
                        'discount_type' => $request->discount_type,
                        'discount_val' => ($request->discount_val) ? $request->discount_val : '',
                    ]);
                    $payment_id = $payment->id;
                }
                else {
                    return response()->json([
                        'msg' => "O'quvchi bu oy uchun to'lov qilgan.",
                    ]);
                }
            }
            else{
                $payment_id = $request->last_payment_id;

                $payment = Payment::findOrFail($payment_id);
                $payment->fill([
                    'discount' => $discount,
                    'discount_type' => $request->discount_type,
                    'discount_val' => ($request->discount_val) ? $request->discount_val : '',
                ]);
                $payment->save();
            }


            if ($payment_id) {

                $payment_detailes = PaymentDetalies::create([
                    'payment_id' => $payment_id,
                    'paid' => $request->paid,
                    'payment_type' => $request->payment_type,
                ]);
            }

            return response()->json([
                'payment' => $payment,
                'payment_detailes' => $payment_detailes
            ]);
        }
        catch (\Exception $exception) {
            return response()->json([$exception]);
        }

    }

    /**
     * Student payment and payment detalies delete
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     **/
    public function student_payment_delete($id)
    {
        PaymentDetalies::where('payment_id','=', $id)->delete();

        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json(['payment_id' => $id]);
    }
}
