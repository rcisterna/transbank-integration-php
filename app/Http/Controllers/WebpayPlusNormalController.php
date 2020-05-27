<?php


namespace App\Http\Controllers;


use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;
use Transbank\Webpay\WebPayNormal;

class WebpayPlusNormalController extends Controller
{
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
