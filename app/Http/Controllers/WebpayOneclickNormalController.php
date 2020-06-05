<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Transbank\Webpay\Configuration;
use Transbank\Webpay\Webpay;
use Transbank\Webpay\WebpayOneClick;

class WebpayOneclickNormalController extends Controller
{
    /**
     * Muestra los usuarios inscritos
     *
     * @param Request $request Datos de la petición entrante
     * @param int $paymentId Identificador del pago
     */
    public function showinscriptions(Request $request, int $paymentId)
    {
        //
    }

    /**
     * Comienza la inscripción de un nuevo usuario
     *
     * @param Request $request Datos de la petición entrante
     * @param int $paymentId Identificador del pago
     */
    public function initInscription(Request $request, int $paymentId)
    {
        //
    }

    /**
     * Confirma la inscripción de un nuevo usuario
     *
     * @param Request $request Datos de la petición entrante
     * @param int $paymentId Identificador del pago
     */
    public function confirmInscription(Request $request, int $paymentId)
    {
        //
    }

    /**
     * Elimina la inscripción de un nuevo usuario
     *
     * @param Request $request Datos de la petición entrante
     * @param int $paymentId Identificador del pago
     * @param int $userId Identificador de usuario inscrito
     */
    public function removeInscription(Request $request, int $paymentId, int $userId)
    {
        //
    }

    /**
     * Autoriza el pago para un usuario inscrito
     *
     * @param Request $request Datos de la petición entrante
     * @param int $paymentId Identificador del pago
     * @param int $userId Identificador de usuario inscrito
     */
    public function authorizePayment(Request $request, int $paymentId, int $userId)
    {
        //
    }

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
