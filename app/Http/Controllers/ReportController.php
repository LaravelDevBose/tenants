<?php

namespace App\Http\Controllers;

use Excel;
use App\Expense;
use App\Payment;
use App\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function index(){
        return view('report.reports');
    }

    public function download_report(Request $request){

        $validation = Validator::make($request->all(),[
            'file_name'=>'required|string',
            'file_type'=>'required',
            'report_for'=>'required',
        ]);
        if($validation->passes()){

            switch ($request->report_for){
                case 1:
                    $query_result = $this->find_tenants_data($request);
                    break;
                case 2:
                    $query_result = $this->find_payment_data($request);
                    break;
                default:
                    $query_result = $this->find_expense_data($request);
                    break;

            }
            $data  = $query_result;
            if(count($data) > 0){
                return Excel::create($request->file_name.'_'.date('Y-m-d_H:i:s'), function($excel) use ($data) {
                    $excel->sheet('mySheet', function($sheet) use ($data)
                    {
                        $sheet->fromArray($data);
                    });
                })->download($request->file_type);
            }

            Session::flash('unsuccess', 'Not Data Found');
            return redirect()->back();

        }

        return redirect()->back()->withErrors($validation)->withInput($request->all());
        


    }

    protected function find_tenants_data($request){

        if( strpos( $request->date_to, '/' ) !== false ) {
            //make date as a date time format
            $date_array = explode('/', $request->date_to);
            $date_to = $date_array[2].'-'.$date_array[0].'-'.$date_array[1].' 00:00:00';
        }else{
            $date_to = $request->date_to;
        }

        if( strpos( $request->date_from, '/' ) !== false ) {
            //make date as a date time format
            $date_array = explode('/', $request->date_from);
            $date_from = $date_array[2].'-'.$date_array[0].'-'.$date_array[1].' 00:00:00';
        }else{
            $date_from = $request->date_form;
        }

        if(isset($request->date_from) && isset($request->date_to)){

            $data_collection = Tenant::whereDate('created_at','>=',$date_from)->whereDate('created_at','<=',$date_to)->get();
        }elseif(isset($request->date_from)){
            $data_collection = Tenant::whereDate('created_at','>=',$date_from)->get();

        }elseif (isset($request->date_to)){
            $data_collection = Tenant::whereDate('created_at','<=',$date_to)->get();

        }else{
            $data_collection=Tenant::get();
        }

        $main_data = array();
        $i=0;
        foreach ($data_collection as $singel_data) {
            $data = array();
            $data['Id Number'] = $singel_data->id_number;
            $data['Full Name'] = $singel_data->full_name;
            $data['Phone Number'] = $singel_data->phone_number;
            $data['Email Address'] = $singel_data->email_address;
            $data['Plot Name/Number'] = $singel_data->plot_name_number;
            $data['House Name/Number'] = $singel_data->house_name_number;
            $data['Room Type'] = ($singel_data->room_type == 1) ? 'Single Room' : ($singel_data->room_type == 2) ? 'Double Room' : 'One BedRoom';
            $data['Rent Amount'] = '$' . number_format($singel_data->rent_amount);
            $data['Balance'] = '$' . number_format($singel_data->balance);
            $data['Gas Bill'] = '$' . number_format($singel_data->gas_bill);
            $data['Net Bill'] = '$' . number_format($singel_data->net_bill);
            $data['Water Bill'] = '$' . number_format($singel_data->water_bill);
            $data['Other Bill'] = '$' . number_format($singel_data->other_bill);


            $main_data[$i++]=$data;
        }
        return $main_data;

    }

    private  function find_payment_data($request){

        if( strpos( $request->date_to, '/' ) !== false ) {
            //make date as a date time format
            $date_array = explode('/', $request->date_to);
            $date_to = $date_array[2].'-'.$date_array[0].'-'.$date_array[1].' 00:00:00';
        }else{
            $date_to = $request->date_to;
        }

        if( strpos( $request->date_from, '/' ) !== false ) {
            //make date as a date time format
            $date_array = explode('/', $request->date_from);
            $date_from = $date_array[2].'-'.$date_array[0].'-'.$date_array[1].' 00:00:00';
        }else{
            $date_from = $request->date_form;
        }

        if(isset($request->date_from) && isset($request->date_to)){

            $data_collection = Payment::whereDate('created_at','>=',$date_from)->whereDate('created_at','<=',$date_to)->get();
        }elseif(isset($request->date_from)){
            $data_collection = Payment::whereDate('created_at','>=',$date_from)->get();

        }elseif (isset($request->date_to)){
            $data_collection = Payment::whereDate('created_at','<=',$date_to)->get();

        }else{
            $data_collection=Payment::get();
        }

        $main_data = array();
        $i=0;

        foreach ($data_collection as $singel_data) {
            $data = array();
            $data['Tenant Name'] = $singel_data->tenant->full_name;
            $data['Rent Amount'] = '$' . number_format($singel_data->rent_amount);
            $data['Balance'] = '$' . number_format($singel_data->balance);
            $data['Gas Bill'] = '$' . number_format($singel_data->gas_bill);
            $data['Net Bill'] = '$' . number_format($singel_data->net_bill);
            $data['Water Bill'] = '$' . number_format($singel_data->water_bill);
            $data['Other Bill'] = '$' . number_format($singel_data->other_bill);
            $data['Total Amount'] = '$' . number_format($singel_data->total_amount);
            $data['Payable Amount'] = '$' . number_format($singel_data->tenant->payable_amount);

            $main_data[$i++]=$data;
        }
        return $main_data;
    }

    private  function find_expense_data($request){
        if( strpos( $request->date_to, '/' ) !== false ) {
            //make date as a date time format
            $date_array = explode('/', $request->date_to);
            $date_to = $date_array[2].'-'.$date_array[0].'-'.$date_array[1].' 00:00:00';
        }else{
            $date_to = $request->date_to;
        }

        if( strpos( $request->date_from, '/' ) !== false ) {
            //make date as a date time format
            $date_array = explode('/', $request->date_from);
            $date_from = $date_array[2].'-'.$date_array[0].'-'.$date_array[1].' 00:00:00';
        }else{
            $date_from = $request->date_form;
        }

        if(isset($request->date_from) && isset($request->date_to)){

            $data_collection = Expense::whereDate('created_at','>=',$date_from)->whereDate('created_at','<=',$date_to)->get();
        }elseif(isset($request->date_from)){
            $data_collection = Expense::whereDate('created_at','>=',$date_from)->get();

        }elseif (isset($request->date_to)){
            $data_collection = Expense::whereDate('created_at','<=',$date_to)->get();

        }else{
            $data_collection=Expense::get();
        }

        $main_data = array();
        $i=0;

        foreach ($data_collection as $singel_data) {
            $data = array();
            $data['Expense Name'] = $singel_data->title;
            $data['Expense Type'] = $singel_data->expenseType->title;
            $data['Expense Date'] = $singel_data->date;
            $data['Amount'] = '$' . number_format($singel_data->amount);
            $data['Payment Type'] = $singel_data->payment_type;
            $data['Note'] = $singel_data->short_note;
            $data['Status'] = ($singel_data->room_type == 1) ? 'Paid' :'Hold';

            $main_data[$i++]=$data;
        }
        return $main_data;
    }
}
