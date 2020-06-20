<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OneclickNormalAuthorization extends Model
{
    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    public function user()
    {
        return $this->belongsTo('App\OneclickNormalUser', 'oneclick_normal_user_id');
    }

    public function getBuyOrderAttribute()
    {
        return intval(sprintf('%d%d', $this->payment_id, $this->created_at->timestamp));
    }
}
