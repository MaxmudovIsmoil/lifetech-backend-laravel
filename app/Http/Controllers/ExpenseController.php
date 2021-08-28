<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cost_type)
    {
        $costs = DB::table('costs')->get();

        if($cost_type == 0)
            $cost_type = $costs[0]->id;

        $expense = DB::table('expenses')
            ->leftJoin('costs', 'costs.id', '=', 'expenses.cost_id')
            ->select('expenses.*', 'costs.name as cname')
            ->where('cost_id', '=', $cost_type)
            ->get();

        return view('expense.index', compact('expense', 'costs'));
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
                Expense::create([
                    'name'  =>  $request->name,
                    'money' =>  $request->money,
                    'comment' =>  '',
                    'cost_id' =>  $request->cost_id
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
                $course = Expense::findOrFail($id);
                $course->fill([
                    'name'  => $request->name,
                    'money' => $request->money,
                    'cost_id' => $request->cost_id,
                ]);
                $course->save();

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
            'money'     => 'required',
            'cost_id'   => 'required',
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
        $u = Expense::findOrFail($id);

        $u->delete();

        return response()->json(['id' => $id]);
    }

}
