<?php


namespace App\Http\Controllers;


use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;
use Transbank\Webpay\WebpayOneClick;

class WebpayOneclickNormalController extends Controller
{
    /**
     * Instancia el objeto de transacción
     *
     * @return WebpayOneClick
     */
    private static function getTransaction(): WebpayOneClick
    {
        $urlRepository = "https://raw.githubusercontent.com/TransbankDevelopers/transbank-webpay-credenciales/master/";
        $dirFiles = "integracion/Webpay%20OneClick%20-%20CLP/597044444405";

        $contentPublicCert = file_get_contents($urlRepository . $dirFiles . ".crt");
        $contentPrivateKey = file_get_contents($urlRepository . $dirFiles . ".key");

        $configuration = new Configuration();
        $configuration->setCommerceCode(597044444405);
        $configuration->setEnvironment("INTEGRACION");
        $configuration->setPrivateKey($contentPrivateKey);
        $configuration->setPublicCert($contentPublicCert);
        $webpay = new Webpay($configuration);
        return $webpay->getOneClickTransaction();
    }
}
