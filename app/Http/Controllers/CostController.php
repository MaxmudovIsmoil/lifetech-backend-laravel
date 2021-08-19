<?php

namespace App\Http\Controllers;


use App\Models\Cost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CostController extends Controller
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
        $costs = DB::table('costs')->get();

        return view('cost.index', compact( 'costs'));
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
            try {
                Cost::create([
                    'name'  =>  $request->name,
                ]);
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
            try {
                $cost = Cost::findOrFail($id);
                $cost->fill([
                    'name'  => $request->name
                ]);
                $cost->save();

                return response()->json(['success' => true]);
            }
            catch (\Exception $exception) {
                return response([
                    'success' => false,
                    'errors' => $exception
                ]);
            }
        }

    }


    public function validateData()
    {
        return [
            'name'      => 'required',
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
        $u = Cost::findOrFail($id);

        $u->delete();

        return response()->json(['id' => $id]);
    }

}
