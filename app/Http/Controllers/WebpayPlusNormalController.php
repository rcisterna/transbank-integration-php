<?php


namespace App\Http\Controllers;


use App\Payment;
use App\WebpayplusNormalTransaction;
use Illuminate\Http\Request;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;
use Transbank\Webpay\WebPayNormal;

class WebpayPlusNormalController extends Controller
{
    /**
     * Inicia el proceso de pago
     *
     * @param Request $request Datos de la petición entrante
     * @param int $paymentId Identificador del pago
     */
    public function init(Request $request, int $paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        if ($payment->status != Payment::STATUS_PENDING_PAYMENT)
        {
            return redirect()->route('payments.index');
        }

        $db_transaction = new WebpayplusNormalTransaction;
        $db_transaction->payment()->associate($payment);
        $db_transaction->save();

        $transaction = self::getTransaction();
        $response = $transaction->initTransaction(
            $db_transaction->payment->amount,
            $db_transaction->buy_order,
            $db_transaction->payment->id,
            route('webpayplus_normal.return'),
            route('webpayplus_normal.final')
        );

        if (is_array($response))
        {
            $error = sprintf('Error: %d. Detail: %s.', $response['error'], $response['detail']);
            $db_transaction->error = html_entity_decode($error);
            $db_transaction->save();
            $payment->status = Payment::STATUS_WP_NORMAL_INIT_ERROR;
            $payment->save();
            return redirect()->route('payments.index');
        }

        $db_transaction->token = $response->token;
        $db_transaction->save();
        $payment->status = Payment::STATUS_WP_NORMAL_INIT_SUCCESS;
        $payment->save();
        return view('webpayplus.normal.init', compact('response'));
    }

    /**
     * Obtiene el resultado de pago
     *
     * @param Request $request Datos de la petición entrante
     */
    public function return(Request $request)
    {
        //
    }

    /**
     * Muestra el resultado de la compra
     *
     * @param Request $request Datos de la petición entrante
     */
    public function final(Request $request)
    {
        //
    }

    /**
     * Instancia el objeto de transacción
     *
     * @return WebPayNormal
     */
    private static function getTransaction(): WebPayNormal
    {
        $urlRepository = "https://raw.githubusercontent.com/TransbankDevelopers/transbank-webpay-credenciales/master/";
        $dirFiles = "integracion/Webpay%20Plus%20-%20CLP/597020000540";

        $contentPublicCert = file_get_contents($urlRepository . $dirFiles . ".crt");
        $contentPrivateKey = file_get_contents($urlRepository . $dirFiles . ".key");

        $configuration = new Configuration();
        $configuration->setCommerceCode(597020000540);
        $configuration->setEnvironment("INTEGRACION");
        $configuration->setPrivateKey($contentPrivateKey);
        $configuration->setPublicCert($contentPublicCert);
        $webpay = new Webpay($configuration);
        return $webpay->getNormalTransaction();
    }
}
