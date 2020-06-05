<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public const STATUS_PENDING_PAYMENT = 0;

    // Webpay Plus Normal status
    public const STATUS_WP_NORMAL_INIT_SUCCESS = 11;
    public const STATUS_WP_NORMAL_INIT_ERROR = 12;
    public const STATUS_WP_NORMAL_FINISH_SUCCESS = 13;
    public const STATUS_WP_NORMAL_FINISH_INVALID = 14;
    public const STATUS_WP_NORMAL_FINISH_ERROR = 15;
    public const STATUS_WP_NORMAL_FINISH_ABORT = 16;
    public const STATUS_WP_NORMAL_FINISH_TIMEOUT = 17;
    public const STATUS_WP_NORMAL_FINISH_FORM_ERROR = 18;

    public const STATUS_DESC = [
        self::STATUS_PENDING_PAYMENT => 'Pendiente de pago',
        self::STATUS_WP_NORMAL_INIT_SUCCESS => 'Pago con Webpay Normal iniciado',
        self::STATUS_WP_NORMAL_INIT_ERROR => 'Error al inciar pago con Webpay Normal',
        self::STATUS_WP_NORMAL_FINISH_SUCCESS => 'Pago con Webpay Normal finalizado',
        self::STATUS_WP_NORMAL_FINISH_INVALID => 'Error de validación al finalizar pago con Webpay Normal',
        self::STATUS_WP_NORMAL_FINISH_ERROR => 'Error al finalizar pago con Webpay Normal',
        self::STATUS_WP_NORMAL_FINISH_ABORT => 'Pago con Webpay Normal abortado',
        self::STATUS_WP_NORMAL_FINISH_TIMEOUT => 'Pago con Webpay Normal cancelado por timeout',
        self::STATUS_WP_NORMAL_FINISH_FORM_ERROR => 'Pago con Webpay Normal con error en formulario de pago',
    ];

    protected $fillable = ['amount'];
}
