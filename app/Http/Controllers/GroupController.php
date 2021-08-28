<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\User;
use App\Models\GroupStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $course = Course::all();

        $teachers = DB::table('users')
            ->select('users.id', 'users.firstname', 'users.lastname')
            ->where('users.utype', 'teacher')
            ->get();

        $id = $request->route('id');

        $group = DB::table('groups')
            ->join('users', 'users.id', "=", 'groups.teacher_id')
            ->join('courses', 'courses.id', '=', 'groups.course_id')
            ->select('groups.*', 'users.firstname', 'users.lastname', 'courses.name as cname', 'courses.price')
            ->where('groups.status', $id)
            ->get();
        $i = 1;

        $days = array('Dushanba', 'Seshanba', 'Chorshanba', 'Payshanba', 'Juma', 'Shanba', 'Yakshanba');


        $groups = array();
        foreach($group as $k => $g) {
            $groups[$k]['id'] = $g->id;
            $groups[$k]['name'] = $g->name;
            $groups[$k]['course_id'] = $g->course_id;
            $groups[$k]['cname'] = $g->cname;
            $groups[$k]['teacher_id'] = $g->teacher_id;
            $groups[$k]['lastname'] = $g->lastname;
            $groups[$k]['firstname'] = $g->firstname;
            $groups[$k]['days'] = explode(';', $g->days);
            $groups[$k]['time'] = substr($g->time, 0, -3);
            $groups[$k]['type'] = $g->type;
            $groups[$k]['status'] = $g->status;
        }

        /** guruhga tegishli studentlar **/
        $group_students =  DB::table('group_students')
            ->join('users', 'users.id', '=', 'group_students.student_id')
            ->select('group_students.*','users.lastname', 'users.firstname', 'users.phone')
            ->get();


        /** Kursni tanlagan studentlar yangi, o'qiyotgan **/
        $student = DB::table('users')
            ->where(array('utype' => 'student', 'status' => 1))
//            ->orWhere('status', 2)
            ->get();

        $students = array();
        foreach($student as $k => $s) {
            $students[$k]['id'] = $s->id;
            $students[$k]['firstname'] = $s->firstname;
            $students[$k]['lastname'] = $s->lastname;
            $students[$k]['phone'] = $s->phone;
            $students[$k]['status'] = $s->status;
            $students[$k]['course_ids'] = explode(';', $s->course_ids);
        }

        return view('group.index', compact('course', 'teachers', 'groups', 'i', 'days', 'students', 'group_students'));
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
            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

            $dayStr = '';
            $t = false;
            foreach($days as $v) {
                if ($request->$v) {
                    $dayStr .= $request->$v . ";";
                    $t = true;
                } else
                    $dayStr .= '0;';
            }

            if (!$t) {
                return response()->json([
                    'success' => false,
                    'errors' => ['days' => 'Kunlarni tanlang']
                ]);
            }
            $day = substr($dayStr, 0, -1);

            try {
                Group::create([
                    'course_id' =>  $request->course_id,
                    'teacher_id'=>  $request->teacher_id,
                    'name'      =>  $request->name,
                    'days'      =>  $day,
                    'time'      =>  $request->time,
                    'type'      =>  $request->type,
                    'status'    => 1
                ]);
                return response()->json([
                    'success' => true,
                ]);
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
            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

            $dayStr = '';
            $t = false;
            foreach($days as $v) {
                if ($request->$v) {
                    $dayStr .= $request->$v.";";
                    $t = true;
                }
                else
                    $dayStr .= '0;';
            }
            if (!$t) {
                return response()->json([
                    'success'=> false,
                    'errors' => ['days' => 'Kunlarni tanlang!']
                ]);
            }
            $day = substr($dayStr, 0, -1);

            /** Guruh yopilganda guruhga tegishli studentlarni course_id larini o'chirish **/
            if ($request->status == 3) {
                $students_ids = DB::table('group_students AS gs')
                    ->leftJoin('users AS u','u.id', '=', 'gs.student_id')
                    ->where('gs.group_id', $id)
                    ->get();

                foreach($students_ids as $k => $v) {

                    $cids = array();
                    foreach(explode(';', $v->course_ids) as $cv) {
                        if($cv === $request->course_id)
                            unset($cv);
                        else
                            $cids[] = $cv;
                    }

                    $student = User::findOrFail($v->student_id);
                    $student->fill([
                        'course_ids' => implode(';', $cids),
                        'status'    => 3,
                    ]);
                    $student->save();

                } // foreach
            } // if

            try {
                $course = Group::findOrFail($id);
                $course->fill([
                    'name'      => $request->name,
                    'course_id' => $request->course_id,
                    'teacher_id'=> $request->teacher_id,
                    'days'      => $day,
                    'time' => ($request->time) ? $request->time : '',
                    'type' => $request->type,
                    'status' => $request->status,
                ]);
                $course->save();
                return response()->json([
                    'success' => true
                ]);

            } catch (\Exception $exception) {
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
            'course_id' => 'required',
            'teacher_id'=> 'required',
            'name'      => 'required',
            'time'      => 'required',
            'type'      => 'required',
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
        $u = Group::findOrFail($id);

        $u->delete();

        return response()->json(['id' => $id]);
    }


    /**
     * add student in group and update.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $id
     * @return \Illuminate\Http\Response
     */
    public function addStudentInGroup(Request $request, $id)
    {
        $oldStudentsInGroup = DB::table('group_students')->where('group_id', $id)->get();
        foreach($oldStudentsInGroup as $os) {
            DB::update('update `users` set status = 1 where id = '.$os->student_id);
        }

        $gsCount = $oldStudentsInGroup->count();
        if ($gsCount)
            DB::table('group_students')->where('group_id', $id)->delete();


        if($request->students_ingroup) {

            foreach($request->students_ingroup as $sg) {

                DB::insert('insert into `group_students` (`group_id`, `student_id`) values ('.$id.', '.$sg.')');
                DB::update('update `users` set status = 2 where id = '.$sg);
            }
        }

        return response()->json(['id' => $request->students_ingroup]);
    }

}
