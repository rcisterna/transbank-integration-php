<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OneclickNormalUser extends Model
{
    use SoftDeletes;

    protected $fillable = ['username', 'email'];

    public function response()
    {
        return $this->hasOne('App\OneclickNormalUserResponse', 'oneclick_normal_user_id');
    }
}
