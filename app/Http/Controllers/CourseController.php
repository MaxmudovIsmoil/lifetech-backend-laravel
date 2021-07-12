<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = Course::all();
        $i = 1;

        return view('course.index', compact('course', 'i'));
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
            'name'  => 'string|required',
            'price'  => 'string|required',
            'month' => 'string|required',
        ]);

        try {
            Course::create([
                'name'  =>  $request->name,
                'price' =>  $request->price,
                'month' =>  $request->month
            ]);
            return redirect()->route('course.index');
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

        $course = Course::findOrFail($id);
        $course->fill([
            'name'  => $request->name,
            'price' => $request->price,
            'month' => $request->month,
        ]);
        $course->save();

        return redirect()->route('course.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $u = Course::findOrFail($id);

        $u->delete();

        return response()->json(['id' => $id]);
    }
}
