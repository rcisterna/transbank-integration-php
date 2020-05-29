<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public const STATUS_PENDING_PAYMENT = 0;
    public const STATUS_WP_NORMAL_INIT_SUCCESS = 1;
    public const STATUS_WP_NORMAL_INIT_ERROR = 2;

    public const STATUS_DESC = [
        self::STATUS_PENDING_PAYMENT => 'Pendiente de pago',
        self::STATUS_WP_NORMAL_INIT_SUCCESS => 'Pago con Webpay Normal iniciado',
        self::STATUS_WP_NORMAL_INIT_ERROR => 'Error al inciar pago con Webpay Normal',
    ];

    protected $fillable = ['amount'];
}
