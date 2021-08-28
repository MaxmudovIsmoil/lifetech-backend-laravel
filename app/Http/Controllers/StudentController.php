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
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    private function studentCounts()
    {
        $studentsAll = DB::table('users')->where(array('utype' => 'student'))->get();

        $students_count = array(
            'all' => 0,
            'new' => 0,
            'study' => 0,
            'graduated' => 0,
            'uneducated' => 0,
        );

        foreach($studentsAll as $s) {
            $students_count['all']++;
            if ($s->status == 1) $students_count['new']++;

            if ($s->status == 2) $students_count['study']++;

            if ($s->status == 3) $students_count['graduated']++;

            if ($s->status == 0) $students_count['uneducated']++;
        }

        return $students_count;
    }

    /** object students convert to array **/
    protected function objStudentConvertToArray($student, $group)
    {
        $course = Course::all();

        $students = array();
        foreach($student as $k => $s) {
            $students[$k]['id'] = $s->id;
            $students[$k]['firstname'] = $s->firstname;
            $students[$k]['lastname'] = $s->lastname;
            $students[$k]['phone'] = $s->phone;
            if ($group) {
                $students[$k]['group_id'] = $s->group_id;
                $students[$k]['group'] = $s->gname;
            }
            $students[$k]['phone2'] = $s->phone2;
            $students[$k]['address'] = $s->address;
            $students[$k]['born'] = date('d.m.Y', strtotime($s->born));
            $students[$k]['status'] = $s->status;
            $students[$k]['cause'] = $s->cause;
            $students[$k]['gender'] = $s->gender;
            $students[$k]['company'] = $s->company;
            $students[$k]['advertising'] = $s->advertising;
            $students[$k]['created_at'] = date('d.m.Y H:i', strtotime($s->created_at));
            $students[$k]['course_ids'] = '';
            foreach ($course as $c) {
                if (in_array($c->id, explode(';', $s->course_ids))) {
                    $students[$k]['course_ids'] .= $c->name.", ";
                }
            }
        }
        return $students;
    }


    /** =========== News =========== **/
    public function newcomers()
    {
        $students_count = $this->studentCounts();
        $advertising = DB::table('advertising')->get();
        $course = Course::all();

        return view('student.newcomers', compact('students_count', 'course', 'advertising'));
    }

    public function getNewcomers()
    {
        $student = DB::table('users')
            ->where(array('utype' => 'student', 'status' => 1))
            ->orderBy('created_at', 'DESC')
            ->get();

        $students = $this->objStudentConvertToArray($student, 0);
        $i = 1;
        return Datatables::of($students)
            ->addColumn('number', function ($i) {
                global $i;
                return ++$i;
            })
            ->addColumn('action', function ($s) {

                $btn = '<div class="dropdown d-inline-block">
                            <svg class="c-icon c-icon-lg" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <use xlink:href="'.url('/icons/sprites/free.svg#cil-options').'"></use>
                            </svg>
                            <div class="dropdown-menu pt-0 pb-0" aria-labelledby="dropdownMenuButton">
                                <a href="'. route('student.getNewcomersStudyShow', [$s['id']]) .'" class="dropdown-item js_show_btn" data-toggle="modal" data-target="#showModal">
                                    <svg class="c-icon c-icon-md mr-2">
                                        <use xlink:href="'. url('/icons/sprites/free.svg#cil-low-vision').'"></use>
                                    </svg> To\'liq ko\'rish
                                </a>
                                <a href="'. route('student.getStudent', [$s['id']]) .'" data-action="'.route('student.update', [$s['id']]).'" class="dropdown-item js_edit_btn" data-toggle="modal" data-target="#editModal">
                                   <svg class="c-icon c-icon-md mr-2">
                                       <use xlink:href="'.url('/icons/sprites/free.svg#cil-color-border').'"></use>
                                   </svg> Tahrirlash
                                </a>
                                <button type="button" data-url="'.route('student.destroy', [$s['id']]).'" data-name="'.$s['firstname'].'" class="dropdown-item js_delete_btn" data-toggle="modal" data-target="#delete_notify">
                                    <svg class="c-icon c-icon-md mr-2">
                                        <use xlink:href="'.url('/icons/sprites/free.svg#cil-trash').'"></use>
                                    </svg> O\'chirish
                                </button>
                            </div>
                        </div>';

                return $btn;
            })
            ->editColumn('id', '{{$id}}')
//            ->setRowId('id')
            ->setRowClass('js_this_tr')
//            ->setRowData(['id' => '{{ $id }}'])
            ->setRowAttr([
                'data-id' => '{{ $id }}',
            ])
            ->make(true);
    }


    /** =========== studies =========== **/
    public function study()
    {
        $students_count = $this->studentCounts();
        $advertising = DB::table('advertising')->get();
        $course = Course::all();

        return view('student.study', compact('students_count', 'course', 'advertising'));
    }

    public function getStudy()
    {
        $student = DB::table('users AS u')
            ->select('u.*', 'gs.group_id', 'g.name AS gname')
            ->where(array('u.utype' => 'student', 'u.status' => 2))
            ->leftJoin('group_students AS gs', 'gs.student_id', '=', 'u.id')
            ->leftJoin('groups AS g', 'g.id', '=', 'gs.group_id')
            ->orderBy('u.created_at', 'DESC')
            ->get();

        $students = $this->objStudentConvertToArray($student, 1);
        $i = 1;
        return Datatables::of($students)
            ->addColumn('number', function ($i) {
                global $i;
                return ++$i;
            })
            ->addColumn('action', function ($s) {

                $btn = '<div class="dropdown d-inline-block">
                            <svg class="c-icon c-icon-lg" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <use xlink:href="'.url('/icons/sprites/free.svg#cil-options').'"></use>
                            </svg>
                            <div class="dropdown-menu pt-0 pb-0" aria-labelledby="dropdownMenuButton">
                                <a href="'.route('studentPayment.student_payments_in_group').'"
                                            data-student-id="'.$s['id'].'"
                                            data-group-id="'.$s['group_id'].'"
                                            data-full-name="'.$s['firstname'].' '.$s['lastname'].', '.$s['group'].'
                                            guruhiga " class="dropdown-item js_payment_btn">
                                    <svg class="c-icon c-icon-md mr-2">
                                        <use xlink:href="'.url('/icons/sprites/free.svg#cil-dollar').'"></use>
                                    </svg> To\'lovlar
                                </a>
                                <a href="'. route('student.getNewcomersStudyShow', [$s['id']]) .'" class="dropdown-item js_show_btn" data-toggle="modal" data-target="#showModal">
                                    <svg class="c-icon c-icon-md mr-2">
                                        <use xlink:href="'. url('/icons/sprites/free.svg#cil-low-vision').'"></use>
                                    </svg> To\'liq ko\'rish
                                </a>
                                <a href="'. route('student.getStudent', [$s['id']]) .'" data-action="'.route('student.update', [$s['id']]).'" class="dropdown-item js_edit_btn" data-toggle="modal" data-target="#editModal">
                                   <svg class="c-icon c-icon-md mr-2">
                                       <use xlink:href="'.url('/icons/sprites/free.svg#cil-color-border').'"></use>
                                   </svg> Tahrirlash
                                </a>
                                <button type="button" data-url="'.route('student.destroy', [$s['id']]).'" data-name="'.$s['firstname'].'" class="dropdown-item js_delete_btn" data-toggle="modal" data-target="#delete_notify">
                                    <svg class="c-icon c-icon-md mr-2">
                                        <use xlink:href="'.url('/icons/sprites/free.svg#cil-trash').'"></use>
                                    </svg> O\'chirish
                                </button>
                            </div>
                        </div>';

                return $btn;
            })
            ->editColumn('id', '{{$id}}')
            ->setRowClass('js_this_tr')
            ->setRowAttr([
                'data-id' => '{{ $id }}',
            ])
            ->make(true);
    }

    /** Student new and study full show **/
    public function getNewcomersStudyShow($id)
    {
        $student = DB::table('users')
            ->where('id', $id)
            ->get();

        $course = Course::all();

        $students = array();
        foreach($student as $k => $s) {
            $students['id'] = $s->id;
            $students['firstname'] = $s->firstname;
            $students['lastname'] = $s->lastname;
            $students['phone'] = $s->phone;
            $students['phone2'] = $s->phone2;
            $students['address'] = $s->address;
            $students['born'] = date('d.m.Y', strtotime($s->born));
            $students['status'] = $s->status;
            $students['gender'] = $s->gender;
            $students['company'] = $s->company;
            $students['advertising'] = $s->advertising;
            $students['created_at'] = date('d.m.Y H:i', strtotime($s->created_at));
            $students['course_ids'] = '';
            foreach ($course as $c) {
                if (in_array($c->id, explode(';', $s->course_ids))) {
                    $students['course_ids'] .= $c->name.", ";
                }
            }
        }
        return response()->json([$students]);

    }



    /** =========== graduated =========== **/
    public function graduated()
    {
        $students_count = $this->studentCounts();
        $advertising = DB::table('advertising')->get();
        $course = Course::all();

        return view('student.graduated', compact('students_count', 'course', 'advertising'));
    }

    public function getGraduated()
    {
        $student = DB::table('users AS u')
            ->select('u.*', 'gs.group_id','g.name AS gname')
            ->where(array('u.utype' => 'student', 'u.status' => 3))
            ->leftJoin('group_students AS gs', 'gs.student_id', '=', 'u.id')
            ->leftJoin('groups AS g', 'g.id', '=', 'gs.group_id')
            ->orderBy('u.created_at', 'DESC')
            ->get();

        $students = $this->objStudentConvertToArray($student, 1);
        $i = 1;
        return Datatables::of($students)
            ->addColumn('number', function ($i) {
                global $i;
                return ++$i;
            })
            ->addColumn('action', function ($s) {

                $btn = '<div class="dropdown d-inline-block">
                            <svg class="c-icon c-icon-lg" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <use xlink:href="'.url('/icons/sprites/free.svg#cil-options').'"></use>
                            </svg>
                            <div class="dropdown-menu pt-0 pb-0" aria-labelledby="dropdownMenuButton">
                                <a href="#" class="dropdown-item js_payment_btn" data-toggle="modal" data-target="#paymentModal">
                                    <svg class="c-icon c-icon-md mr-2">
                                        <use xlink:href="'.url('/icons/sprites/free.svg#cil-dollar').'"></use>
                                    </svg> To\'lovlar
                                </a>
                                <a href="'. route('student.getGraduatedShow', [$s['id']]) .'" class="dropdown-item js_show_btn" data-toggle="modal" data-target="#showModal">
                                    <svg class="c-icon c-icon-md mr-2">
                                        <use xlink:href="'. url('/icons/sprites/free.svg#cil-low-vision').'"></use>
                                    </svg> To\'liq ko\'rish
                                </a>
                                <a href="'. route('student.getStudent', [$s['id']]) .'" data-action="'.route('student.update', [$s['id']]).'" class="dropdown-item js_edit_btn" data-toggle="modal" data-target="#editModal">
                                   <svg class="c-icon c-icon-md mr-2">
                                       <use xlink:href="'.url('/icons/sprites/free.svg#cil-color-border').'"></use>
                                   </svg> Tahrirlash
                                </a>
                                <button type="button" data-url="'.route('student.destroy', [$s['id']]).'" data-name="'.$s['firstname'].'" class="dropdown-item js_delete_btn" data-toggle="modal" data-target="#delete_notify">
                                    <svg class="c-icon c-icon-md mr-2">
                                        <use xlink:href="'.url('/icons/sprites/free.svg#cil-trash').'"></use>
                                    </svg> O\'chirish
                                </button>
                            </div>
                        </div>';

                return $btn;
            })
            ->editColumn('id', '{{$id}}')
            ->setRowClass('js_this_tr')
            ->setRowAttr([
                'data-id' => '{{ $id }}',
            ])
            ->make(true);
    }

    public function getGraduatedShow($id)
    {
        $student = DB::table('users AS u')
            ->select('u.*', 'gs.group_id','g.name AS gname')
            ->where( 'u.id', $id)
            ->join('group_students AS gs', 'gs.student_id', '=', 'u.id')
            ->join('groups AS g', 'g.id', '=', 'gs.group_id')
            ->orderBy('u.created_at', 'DESC')
            ->get();

        $course = Course::all();

        $students = array();
        foreach($student as $k => $s) {
            $students['id'] = $s->id;
            $students['firstname'] = $s->firstname;
            $students['lastname'] = $s->lastname;
            $students['phone'] = $s->phone;
            $students['gname'] = $s->gname;
            $students['phone2'] = $s->phone2;
            $students['address'] = $s->address;
            $students['born'] = date('d.m.Y', strtotime($s->born));
            $students['status'] = $s->status;
            $students['gender'] = $s->gender;
            $students['company'] = $s->company;
            $students['advertising'] = $s->advertising;
            $students['created_at'] = date('d.m.Y H:i', strtotime($s->created_at));
            $students['course_ids'] = '';
            foreach ($course as $c) {
                if (in_array($c->id, explode(';', $s->course_ids))) {
                    $students['course_ids'] .= $c->name.", ";
                }
            }
        }
        return response()->json([$students]);

    }


    /** =========== uneducated =========== **/
    public function uneducated()
    {
        $students_count = $this->studentCounts();
        $advertising = DB::table('advertising')->get();
        $course = Course::all();

        return view('student.uneducated', compact('students_count', 'course', 'advertising'));
    }

    public function getUneducated()
    {
        $student = DB::table('users AS u')
            ->select('u.*')
            ->where(array('u.utype' => 'student', 'u.status' => 0))
            ->orderBy('u.created_at', 'DESC')
            ->get();

        $students = $this->objStudentConvertToArray($student, 0);
        $i = 1;
        return Datatables::of($students)
            ->addColumn('number', function ($i) {
                global $i;
                return ++$i;
            })
            ->addColumn('action', function ($s) {

                $btn = '<div class="dropdown d-inline-block">
                            <svg class="c-icon c-icon-lg" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <use xlink:href="'.url('/icons/sprites/free.svg#cil-options').'"></use>
                            </svg>
                            <div class="dropdown-menu pt-0 pb-0" aria-labelledby="dropdownMenuButton">
                                <a href="'. route('student.getUneducatedShow', [$s['id']]) .'" class="dropdown-item js_show_btn" data-toggle="modal" data-target="#showModal">
                                    <svg class="c-icon c-icon-md mr-2">
                                        <use xlink:href="'. url('/icons/sprites/free.svg#cil-low-vision').'"></use>
                                    </svg> To\'liq ko\'rish
                                </a>
                                <a href="'. route('student.getStudent', [$s['id']]) .'" data-action="'.route('student.update', [$s['id']]).'" class="dropdown-item js_edit_btn" data-toggle="modal" data-target="#editModal">
                                   <svg class="c-icon c-icon-md mr-2">
                                       <use xlink:href="'.url('/icons/sprites/free.svg#cil-color-border').'"></use>
                                   </svg> Tahrirlash
                                </a>
                                <button type="button" data-url="'.route('student.destroy', [$s['id']]).'" data-name="'.$s['firstname'].'" class="dropdown-item js_delete_btn" data-toggle="modal" data-target="#delete_notify">
                                    <svg class="c-icon c-icon-md mr-2">
                                        <use xlink:href="'.url('/icons/sprites/free.svg#cil-trash').'"></use>
                                    </svg> O\'chirish
                                </button>
                            </div>
                        </div>';

                return $btn;
            })
            ->editColumn('id', '{{$id}}')
            ->setRowClass('js_this_tr')
            ->setRowAttr([
                'data-id' => '{{ $id }}',
            ])
            ->make(true);
    }

    public function getUneducatedShow($id)
    {
        $student = DB::table('users AS u')
            ->select('u.*')
            ->where( 'u.id', $id)
            ->orderBy('u.created_at', 'DESC')
            ->get();

        $course = Course::all();

        $students = array();
        foreach($student as $k => $s) {
            $students['id'] = $s->id;
            $students['firstname'] = $s->firstname;
            $students['lastname'] = $s->lastname;
            $students['phone'] = $s->phone;
            $students['phone2'] = $s->phone2;
            $students['address'] = $s->address;
            $students['born'] = date('d.m.Y', strtotime($s->born));
            $students['status'] = $s->status;
            $students['cause'] = $s->cause;
            $students['gender'] = $s->gender;
            $students['company'] = $s->company;
            $students['advertising'] = $s->advertising;
            $students['created_at'] = date('d.m.Y H:i', strtotime($s->created_at));
            $students['course_ids'] = '';
            foreach ($course as $c) {
                if (in_array($c->id, explode(';', $s->course_ids))) {
                    $students['course_ids'] .= $c->name.", ";
                }
            }
        }
        return response()->json([$students]);
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
                    'cause'    => '',
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


    public function getStudent($id)
    {
        $student = User::findOrFail($id);
        return response()->json(['student' => $student]);
    }

    public function getStudentShow($id)
    {
        $student = User::findOrFail($id);
        return response()->json(['student' => $student]);
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
                    'cause'     => isset($request->cause) ? $request->cause : '',
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

        DB::table('group_students')->where('student_id', $id)->delete();

        return response()->json(['id' => $id]);
    }


}
