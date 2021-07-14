<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
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

        $expense = DB::table('expenses')
            ->leftJoin('costs', 'costs.id', '=', 'expenses.cost_id')
            ->select('expenses.*', 'costs.name as cname')
            ->get();

        $i = 1;

        return view('expense.index', compact('expense', 'i', 'costs'));
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
            'money'  => 'string|required',
            'cost_id' => 'string|required',
        ]);

        try {
            Expense::create([
                'name'  =>  $request->name,
                'money' =>  $request->money,
                'comment' =>  '',
                'cost_id' =>  $request->cost_id
            ]);
            return redirect()->route('expense.index');
        } catch (\Exception $exception) {
            dd($exception);
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
        $course = Expense::findOrFail($id);
        $course->fill([
            'name'  => $request->name,
            'money' => $request->money,
            'cost_id' => $request->cost_id,
        ]);
        $course->save();

        return redirect()->route('expense.index');

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
