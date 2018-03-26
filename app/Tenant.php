<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable=[
        'id_number', 'full_name', 'phone_number', 'email_address','image','plot_name_number','house_name_number','room_type',
        'rent_amount','balance','gas_bill','water_bill','net_bill','other_bill'
    ];
    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = ucfirst($value);
    }
    public function setGasBillAttribute($value)
    {
        $this->attributes['gas_bill'] = is_null($value) ? 0 : $value;
    }
    public function setWaterBillAttribute($value)
    {
        $this->attributes['water_bill'] = is_null($value) ? 0 : $value;
    }
    public function setNetBillAttribute($value)
    {
        $this->attributes['net_bill'] = is_null($value) ? 0 : $value;
    }
    public function setOtherBillAttribute($value)
    {
        $this->attributes['other_bill'] = is_null($value) ? 0 : $value;
    }

    public function getTotalAmountAttribute($value)
    {
        return $this->rent_amount + $this->gas_bill + $this->water_bill + $this->net_bill + $this->other_bill ;
    }

    public function getPayableAmountAttribute($value)
    {
        return $this->payment()->sum('total_amount') - $this->paymentHistory()->sum('amount');
    }


    public function paymentHistory(){
        return $this->hasMany('App\PaymentHistory');
    }

    public function payment(){
        return $this->hasMany('App\Payment');
    }

}
