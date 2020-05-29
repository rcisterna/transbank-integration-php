<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebpayplusNormalResponse extends Model
{
    protected $dates = ['transaction_date', 'accounting_date', 'card_expiration_date'];

    public function transaction()
    {
        return $this->belongsTo('App\WebpayplusNormalTransaction', 'webpayplus_normal_transaction_id');
    }

    public function getIsValidAttribute()
    {
        $valid_buy_order = $this->buy_order == $this->transaction->buy_order;
        $valid_session_id = $this->session_id == $this->transaction->payment->id;
        $valid_amount = $this->amount == $this->transaction->payment->amount;
        return $valid_buy_order && $valid_session_id && $valid_amount;
    }
}
