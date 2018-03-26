<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable=[
        'title','expenses_type','date', 'amount','payment_type','short_note', 'status'
    ];

    public function expenseType(){
        return $this->hasOne('App\ExpensesType','id','expenses_type');
    }
}
