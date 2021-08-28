<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
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
        $rules = $this->validateData();
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $error->getMessageBag()->toArray()
            ));
        }
        else {

            try {
                Course::create([
                    'name'  =>  $request->name,
                    'price' =>  $request->price,
                    'month' =>  $request->month
                ]);
                return response()->json([
                    'success' => true,
                ]);
            } catch (\Exception $exception) {
                return response()->json([
                    'success' => false,
                    'error' => $exception
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
        $rules = $this->validateData();
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $error->getMessageBag()->toArray()
            ));
        }
        else {
            $course = Course::findOrFail($id);
            $course->fill([
                'name'  => $request->name,
                'price' => $request->price,
                'month' => $request->month,
            ]);
            $course->save();

            return response()->json([
                'success' => true,
            ]);
        }

    }

    public function validateData()
    {
        return array(
            'name'  => 'required',
            'price' => 'required',
            'month' => 'required',
        );
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
