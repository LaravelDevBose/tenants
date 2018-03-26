<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpensesType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){
            if( strpos( $request->date_from, '/' ) !== false ) {
                //make date as a date time format
                $date_array = explode('/', $request->date_from);
                $date_from = $date_array[2].'-'.$date_array[0].'-'.$date_array[1].' 00:00:00';
            }else{
                $date_from = $request->date_form;
            }

            if( strpos( $request->date_to, '/' ) !== false ) {
                //make date as a date time format
                $date_array = explode('/', $request->date_to);
                $date_to = $date_array[2].'-'.$date_array[0].'-'.$date_array[1].' 00:00:00';
            }else{
                $date_to = $request->date_to;
            }


            $expenses = Expense::whereDate('date','<',$date_from)->get();
            return view('expenses.expenseSearch',['expenses'=>$expenses]);
        }else{
            $expenses = Expense::orderBy('id','desc')->get();
            return view('expenses.expenses',['expenses'=>$expenses]);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expenseTypes = ExpensesType::all();
        return view('expenses.create', ['expenseTypes'=>$expenseTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $report = Validator::make($request->all(),[
            'title'=>'required|max:80',
            'expenses_type'=>'required',
            'date'=>'required',
            'amount'=>'required',
            'payment_type'=>'required',
            'status'=>'required',
            'short_note'=>'max:150',
        ]);

        if($report->passes()){

            if( strpos( $request->date, '/' ) !== false ) {
                //make date as a date time format
                $date_array = explode('/', $request->date);
                $date = $date_array[2].'-'.$date_array[0].'-'.$date_array[1].' 00:00:00';
            }else{
                $date = $request->date;
            }


            $expense = new Expense;
            $expense->title = $request->title;
            $expense->expenses_type = $request->expenses_type;
            $expense->date = $date;
            $expense->amount = $request->amount;
            $expense->payment_type = $request->payment_type;
            $expense->short_note = $request->short_note;
            $expense->status = $request->status;
            $expense->save();

            Session::flash('success','Expenses Information Stored Successfully !');
            return redirect()->back();
        }

        return redirect()->back()->withErrors($report)->withInput($request->all());
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
        $expenseTypes = ExpensesType::all();
        $expense = Expense::find($id);
        return view('expenses.edit',['expenseTypes'=>$expenseTypes,'expense'=>$expense]);
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
        $report = Validator::make($request->all(),[
            'title'=>'required|max:80',
            'expenses_type'=>'required',
            'date'=>'required',
            'amount'=>'required',
            'payment_type'=>'required',
            'status'=>'required',
            'short_note'=>'max:150',
        ]);

        if($report->passes()){


            if( strpos( $request->date, '/' ) !== false ) {
                //make date as a date time format
                $date_array = explode('/', $request->date);
                $date = $date_array[2].'-'.$date_array[0].'-'.$date_array[1].' 00:00:00';
            }else{
                $date = $request->date;
            }


            $expense = Expense::find($id);
            $expense->title = $request->title;
            $expense->expenses_type = $request->expenses_type;
            $expense->date = $date;
            $expense->amount = $request->amount;
            $expense->payment_type = $request->payment_type;
            $expense->short_note = $request->short_note;
            $expense->status = $request->status;
            $expense->save();

            Session::flash('success','Expenses Information Updated Successfully !');
            return redirect()->back();
        }

        return redirect()->back()->withErrors($report)->withInput($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::find($id)->delete();
        $data = ['success'];
        return response()->json($data);
    }


    public function expenseTypeStore(Request $request){

        $type = new ExpensesType;
        $type->title = $request->title;
        $type->save();

        $data = ExpensesType::latest()->pluck('title','id');
        return response()->json($data);
    }

    public function expenseTypeUpdate(Request $request, $id){

        $type = ExpensesType::find($id);
        $type->title = $request->title;
        $type->save();

        $data = ExpensesType::latest()->pluck('title','id');
        return response()->json($data);
    }
    public function expenseTypeDelete($id){
        $check = Expense::where('expenses_type',$id)->get();

        if(count($check) <= 0){

            ExpensesType::find($id)->delete();
            $data = ['yes'];
            return response()->json($data);
        }
        Session::flash('warning','This Expense Type Contain Expense Info Delete First!');
        return;
    }

    public function expenseSearch($from, $to){


    }
}
