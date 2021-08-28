<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $costs = DB::table('costs')->get();
//
//        $expense = DB::table('expenses')
//            ->leftJoin('costs', 'costs.id', '=', 'expenses.cost_id')
//            ->select('expenses.*', 'costs.name as cname')
//            ->get();
//
//        $i = 1;

        return view('report.index');
    }


    /**
     * Report form_date between to_date show
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $title = '';

        $validation = $request->validate([
            'from_date' => 'required',
            'to_date'   => 'required'
        ]);

        if ($validation) {
            try {



                return view('report.index', compact('title', 'costs'));
            } catch (\Exception $exception) {
                dd($exception);
            }
        }

    }


}
