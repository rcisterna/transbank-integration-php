<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OneclickNormalUserResponse extends Model
{
    public function user()
    {
        return $this->belongsTo('App\OneclickNormalUser', 'oneclick_normal_user_id');
    }
}
