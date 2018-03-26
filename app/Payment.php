<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable=[
        'tenant_id','rent_amount','gas_bill','water_bill','net_bill','other_bill','total_amount','status'
    ];

    public function payment_history(){
        return $this->hasMany('App\PaymentHistory');
    }
    public function tenant(){
        return $this->belongsTo('App\Tenant');
    }

    public function paid_amount($month, $year){
        return $this->hasMany('App\PaymentHistory')->whereMonth('created_at',$month)->whereYear('created_at',$year)->sum('amount');
    }
}
