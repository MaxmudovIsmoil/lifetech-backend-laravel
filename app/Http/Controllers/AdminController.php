<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Admin page";

        $students = DB::table('users')->where(array('utype' => 'student'))->get();

        $students_new = DB::table('users')->where(array('utype' => 'student', 'status' => 1))->count();

        $students_active = DB::table('users')->where(array('utype' => 'student', 'status' => 2))->count();

        $students_graduated = DB::table('users')->where(array('utype' => 'student', 'status' => 3))->count();

        $students_count = array(
            'all' => 0,
            'new' => 0,
            'active' => 0,
            'graduated' => 0,
            'no_study' => 0,
        );

        foreach($students as $s) {
            $students_count['all']++;

            if ($s->status == 1)
                $students_count['new']++;

            if ($s->status == 2)
                $students_count['active']++;

            if ($s->status == 3)
                $students_count['graduated']++;

            if ($s->status == 0)
                $students_count['no_study']++;

        }

        return view('admin.index', compact('title', 'students_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
