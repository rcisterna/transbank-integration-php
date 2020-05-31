<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public const STATUS_PENDING_PAYMENT = 0;
    public const STATUS_WP_NORMAL_INIT_SUCCESS = 1;
    public const STATUS_WP_NORMAL_INIT_ERROR = 2;
    public const STATUS_WP_NORMAL_FINISH_SUCCESS = 3;
    public const STATUS_WP_NORMAL_FINISH_INVALID = 4;
    public const STATUS_WP_NORMAL_FINISH_ERROR = 5;
    public const STATUS_WP_NORMAL_FINISH_ABORT = 6;

    public const STATUS_DESC = [
        self::STATUS_PENDING_PAYMENT => 'Pendiente de pago',
        self::STATUS_WP_NORMAL_INIT_SUCCESS => 'Pago con Webpay Normal iniciado',
        self::STATUS_WP_NORMAL_INIT_ERROR => 'Error al inciar pago con Webpay Normal',
        self::STATUS_WP_NORMAL_FINISH_SUCCESS => 'Pago con Webpay Normal finalizado',
        self::STATUS_WP_NORMAL_FINISH_INVALID => 'Error de validación al finalizar pago con Webpay Normal',
        self::STATUS_WP_NORMAL_FINISH_ERROR => 'Error al finalizar pago con Webpay Normal',
        self::STATUS_WP_NORMAL_FINISH_ABORT => 'Pago con Webpay Normal abortado',
    ];

    protected $fillable = ['amount'];
}
