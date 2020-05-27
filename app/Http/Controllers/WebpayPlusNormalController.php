<?php


namespace App\Http\Controllers;


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
        //
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
