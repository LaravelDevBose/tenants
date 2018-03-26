<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Payment;
use App\PaymentHistory;
use App\Tenant;
use App\UserRating;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');

        $this->paymentCount();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants_count= Tenant::count();
        $total_expense= Expense::sum('amount');
        $total_income= PaymentHistory::sum('amount');
        $total_payment= Payment::sum('total_amount');

        $current_month_payment = Payment::whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->get();

        $result = $this->cheart_result();

        $chart=Charts::multi('bar', 'highcharts')
                ->title(" ")
                ->elementLabel("Total")
                ->dimensions(0, 400)
                ->template("material")
                ->responsive(false)
                ->dataset('Income', $result[0])
                ->dataset('Expense', $result[1])
                ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ]);


        return view('home.home',['tenants_count'=>$tenants_count, 'total_expense'=>$total_expense,'chart'=>$chart,
            'total_income'=>$total_income,'total_payment'=>$total_payment,'current_month_payment'=>$current_month_payment]);
    }

    public function ratingStore(Request $request){

        $rating = new UserRating;
        $rating->name = $request->name;
        $rating->email = $request->email;
        $rating->message = $request->message;
        $rating->save();

        Session::flush('success','Thank You For Your Great Suggestion');
        return redirect()->route('tenants.index');

    }

    public function ratingView(){

        if(Auth::User()->id !== 1){
            return redirect()->back();
        }
        $ratings = UserRating::orderBy('id','desc')->get();
        return view('rating.view',['ratings'=>$ratings]);
    }

    public function ratingShow($id){

        if(Auth::User()->id !== 1){
            return redirect()->back();
        }

        $rating = UserRating::find($id);
        return view('rating.rating',['rating'=>$rating]);
    }

    private function cheart_result(){
        $result=array();
        $income = array();
        $expense = array();
        for($i = 1; $i<=12; $i++){
            $monthly_income =PaymentHistory::whereMonth('created_at',$i)->whereYear('created_at',date('Y'))->sum('amount');
            $monthly_expense =Expense::whereMonth('created_at',$i)->whereYear('created_at',date('Y'))->sum('amount');

            $income[$i-1]=$monthly_income;
            $expense[$i-1]=$monthly_expense;
        }
        $result[0]=$income;
        $result[1]=$expense;

        return $result;
    }

    private function paymentCount(){
        $current_year = Date('Y');
        $current_month = Date('m');
        $current_year_month_date = $current_year.'-'.$current_month.'-01';

        //get Data Where Tenant Store previous current Month

        $tenants = Tenant::whereDate('created_at','<',$current_year_month_date)->get();

        foreach($tenants as $tenant){
            $payment = $tenant->payment()->whereMonth('created_at', $current_month)->whereYear('created_at',$current_year)->first();
            //check this Tenant Payment Already Store or not
            if(is_null($payment) && empty($payment)){
                //if not Store Than Count
                $payment = new Payment;
                $payment->tenant_id = $tenant->id;
                $payment->rent_amount = $tenant->rent_amount;
                $payment->gas_bill = $tenant->gas_bill;
                $payment->water_bill = $tenant->water_bill;
                $payment->net_bill = $tenant->net_bill;
                $payment->other_bill = $tenant->other_bill;
                $payment->total_amount = $tenant->total_amount;
                $payment->status = 0;
                $payment->save();
            }
        }

    }
}
