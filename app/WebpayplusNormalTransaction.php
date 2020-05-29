<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebpayplusNormalTransaction extends Model
{
    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    public function response()
    {
        return $this->hasOne('App\WebpayplusNormalResponse', 'webpayplus_normal_transaction_id');
    }

    public function getBuyOrderAttribute()
    {
        return sprintf('tbk_%d_%d', $this->payment_id, $this->created_at->timestamp);
    }
}
