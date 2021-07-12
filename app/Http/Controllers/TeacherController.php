<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
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
    public function index()
    {
        $teacher = DB::table('users')->where('utype','teacher')->get();
        $i = 1;


        $course = Course::all();

        $teachers = array();
        foreach($teacher as $k => $t) {

            $teachers[$k]['id'] = $t->id;
            $teachers[$k]['username'] = $t->username;
            $teachers[$k]['firstname'] = $t->firstname;
            $teachers[$k]['lastname'] = $t->lastname;
            $teachers[$k]['phone'] = $t->phone;
            $teachers[$k]['address'] = $t->address;
            $teachers[$k]['born'] = $t->born;
            $teachers[$k]['status'] = $t->status;
            $teachers[$k]['gender'] = $t->gender;
            $teachers[$k]['company'] = $t->company;
            $teachers[$k]['advertising'] = $t->advertising;
            $teachers[$k]['created_at'] = $t->created_at;
            $teachers[$k]['course_ids'] = explode(';', $t->course_ids);

        }

        return view('teacher.index', compact('teachers', 'course', 'i'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation =  Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password'  => ['required', 'min:6'],
            'password_confirm' => ['required_with:password', 'same:password', 'min:6'],
            'lastname'  => ['required','string'],
            'phone'     => 'required',
            'address'   => 'required',
            'born'   => 'required',
            'company'   => 'required',
        ]);

        if (!$validation->passes()) {
                return response()->json([
                    'status' => 0,
                    'error' => $validation->errors()->all(),
                ]);
        }

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
                'username'  => $request->username,
                'password'  => Hash::make($request->password),
                'token'     => $request->_token,
                'firstname' => $request->firstname,
                'lastname'  => $request->lastname,
                'phone'     => "+998".$request->phone,
                'address'   => $request->address,
                'born'      => isset($request->born) ? $request->born : "",
                'utype'     => "teacher",
                'email'     => "teacher".time()."@gmail.com",
                'status'    => '1',
                'course_ids' => $course_ids,
                'gender'    => isset($request->gender) ? $request->gender : "",
                'advertising' => isset($request->advertising) ? $request->advertising : "",
                'company'   => isset($request->company) ? $request->company : "",
            ]);

            return response()->json([
                'status' => 1,
                'message' => 'bazaga muofaqiyatli yozildi',
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => 2,
                'message' => $exception,
            ]);
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
        if ($request->password) {

            $validation =  Validator::make($request->all(), [
                'password'  => ['required', 'min:6'],
                'password_confirm' => ['required_with:password', 'same:password', 'min:6'],
                'firstname' => ['required', 'string', 'max:255'],
                'lastname'  => ['required','string'],
                'phone'     => 'required',
                'address'   => 'required',
                'born'   => 'required',
                'company'   => 'required',
            ]);

            if (!$validation->passes()) {
                return response()->json([
                    'status' => 0,
                    'error' => $validation->errors()->all(),
                ]);
            }

            $course_ids = '';
            $courses = Course::all();
            foreach($courses as $c) {
                if($request->post('course_'.$c->id) == true){
                    $course_ids .= $request->post('course_'.$c->id).";";
                }
            }
            $course_ids = substr($course_ids, 0, -1);


            $studentsOnce = User::findOrFail($id);
            $studentsOnce->fill([
                'password'  => isset($request->password) ? Hash::make($request->password) : null,
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
        else {

            $validation =  Validator::make($request->all(), [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname'  => ['required','string'],
                'phone'     => 'required',
                'address'   => 'required',
                'born'   => 'required',
                'company'   => 'required',
            ]);

            if (!$validation->passes()) {
                return response()->json([
                    'status' => 0,
                    'error' => $validation->errors()->all(),
                ]);
            }

            $course_ids = '';
            $courses = Course::all();
            foreach($courses as $c) {
                if($request->post('course_'.$c->id) == true){
                    $course_ids .= $request->post('course_'.$c->id).";";
                }
            }
            $course_ids = substr($course_ids, 0, -1);


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

        return response()->json(['status' => 'success', 'id' => $id]);
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
}
