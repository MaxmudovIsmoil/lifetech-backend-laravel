<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $student = DB::table('users')->where(array('utype' => 'student', 'status' => $id))->get();
        $i = 1;

        $course = Course::all();

        $students = array();
        foreach($student as $k => $s) {

            $students[$k]['id'] = $s->id;
            $students[$k]['firstname'] = $s->firstname;
            $students[$k]['lastname'] = $s->lastname;
            $students[$k]['phone'] = $s->phone;
            $students[$k]['address'] = $s->address;
            $students[$k]['born'] = $s->born;
            $students[$k]['status'] = $s->status;
            $students[$k]['gender'] = $s->gender;
            $students[$k]['company'] = $s->company;
            $students[$k]['advertising'] = $s->advertising;
            $students[$k]['created_at'] = $s->created_at;
            $students[$k]['course_ids'] = explode(';', $s->course_ids);

        }

        /** student payments **/
        $p = DB::table('payments AS p')
            ->leftJoin('groups AS g', 'g.id' ,'=', 'p.group_id')
            ->leftJoin('courses AS c', 'c.id' ,'=', 'g.course_id')
            ->select('c.name AS cname', 'c.price AS cprice', 'c.month AS cmonth', 'g.name AS gname', 'g.status AS gstatus', 'p.*')
            ->where('p.student_id','4')
            ->where('g.status','2')
            ->get();

        $pd = DB::table('payments AS p')
            ->leftJoin('payment_detalies AS pd', 'pd.payment_id', '=','p.id')
            ->select( 'pd.payment_id', DB::raw('SUM(pd.paid) as paid'))
            ->groupBy('pd.payment_id')
            ->get();

//        echo "<pre>";
//        print_r($p);
//        echo "</pre>";
//
//        $arr = array();
//        foreach($pd as $k => $v) {
//            $arr[$v->payment_id] = $v->paid;
//        }
//        echo "<pre>";
//        print_r($arr);
//        echo "</pre>";


        return view('student.index', compact('students', 'course', 'i'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'firstname' => 'required',
            'lastname'  => 'required',
            'phone'     => 'required',
            'address'   => 'required',
        ]);


        $course_ids = '';
        $courses = Course::all();
        foreach($courses as $c) {
            if($request->post('course_'.$c->id) == true){
                $course_ids .= $request->post('course_'.$c->id).";";
            }
        }
        $course_ids = substr($course_ids, 0, -1);

        try {
            User::create([
                'username'  => '',
                'password'  => '',
                'token'     => $request->_token,
                'firstname' => $request->firstname,
                'lastname'  => $request->lastname,
                'phone'     => "+998".$request->phone,
                'address'   => $request->address,
                'born'      => isset($request->born) ? $request->born : "",
                'utype'     => "student",
                'email'     => "student".time()."@gmail.com",
                'status'    => '1',
                'course_ids' => $course_ids,
                'gender'    => isset($request->gender) ? $request->gender : "",
                'advertising' => isset($request->advertising) ? $request->advertising : "",
                'company'   => isset($request->company) ? $request->company : "",
            ]);
            return redirect()->route('student.index',[1]);
        } catch (\Exception $exception) {
            dd($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['id' => $id]);
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

        $validate = $request->validate([
            'firstname' => 'required',
            'lastname'  => 'required',
            'phone'     => 'required',
            'address'   => 'required',
        ]);

        $course_ids = '';
        $courses = Course::all();
        foreach($courses as $c) {
            if($request->post('course_'.$c->id) == true){
                $course_ids .= $request->post('course_'.$c->id).";";
            }
        }
        $course_ids = substr($course_ids, 0, -1);


        if ($validate){

            $studentsOnce = User::findOrFail($id);
            $studentsOnce->fill([
                'firstname' => $request->firstname,
                'lastname'  => $request->lastname,
                'phone'     => "+998".$request->phone,
                'address'   => $request->address,
                'gender'    => $request->gender,
                'born'      => isset($request->born) ? $request->born : '',
                'status'    => isset($request->status) ? $request->status : '1',
                'company'   => isset($request->company) ? $request->company : '',
                'advertising'=> isset($request->advertising) ? $request->advertising : '',
                'course_ids'=> $course_ids,
            ]);
            $studentsOnce->save();
        }
        else
            echo 'validate error';


        return redirect()->route('student.index',[1]);
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
}
