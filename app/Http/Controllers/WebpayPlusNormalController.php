<?php


namespace App\Http\Controllers;


use App\Payment;
use App\WebpayplusNormalResponse;
use App\WebpayplusNormalTransaction;
use Carbon\Carbon;
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
        $token = $request->input('token_ws');
        $db_transaction = WebpayplusNormalTransaction::where('token', $token)->first();
        if (!$db_transaction || $db_transaction->payment->status != Payment::STATUS_WP_NORMAL_INIT_SUCCESS)
        {
            return redirect()->route('payments.index');
        }

        $transaction = self::getTransaction();
        $response = $transaction->getTransactionResult($token);

        $db_response = new WebpayplusNormalResponse;
        $db_response->transaction()->associate($db_transaction);

        if (is_array($response))
        {
            $error = sprintf('Error: %d. Detail: %s.', $response['error'], $response['detail']);
            $db_response->error = html_entity_decode($error);
            $db_response->save();
            $db_transaction->payment->status = Payment::STATUS_WP_NORMAL_FINISH_ERROR;
            $db_transaction->payment->save();
            return redirect()->route('payments.index');
        }

        $db_response->buy_order = $response->buyOrder;
        $db_response->session_id = $response->sessionId;
        $db_response->transaction_date = $response->transactionDate;
        $db_response->accounting_date = Carbon::createFromFormat('md', $response->accountingDate, 'America/Santiago');
        $db_response->vci = $response->VCI;
        $db_response->card_number = $response->cardDetail->cardNumber;
        $db_response->card_expiration_date = $response->cardDetail->cardExpirationDate;
        $db_response->amount = $response->detailOutput->amount;
        $db_response->authorization_code = $response->detailOutput->authorizationCode;
        $db_response->payment_type_code = $response->detailOutput->paymentTypeCode;
        $db_response->response_code = $response->detailOutput->responseCode;
        if (isset($response->detailOutput->responseDescription))
        {
            $db_response->response_description = $response->detailOutput->responseDescription;
        }
        $db_response->shares_number = $response->detailOutput->sharesNumber;
        $db_response->save();

        if (!$db_response->is_valid)
        {
            $db_transaction->payment->status = Payment::STATUS_WP_NORMAL_FINISH_INVALID;
            $db_transaction->payment->save();
            return redirect()->route('payments.index');
        }

        $db_transaction->payment->status = Payment::STATUS_WP_NORMAL_FINISH_SUCCESS;
        $db_transaction->payment->save();
        return view('webpayplus.normal.return', compact('response', 'token'));
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
