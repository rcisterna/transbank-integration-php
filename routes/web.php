<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Payment routes
$router->get('/', ['as' => 'payments.index', 'uses' => 'PaymentController@index']);
$router->post('/', ['as' => 'payments.store', 'uses' => 'PaymentController@store']);

// Webpay Plus Normal routes
$router->get(
    '/webpayplus/normal/{paymentId}',
    ['as' => 'webpayplus_normal.init', 'uses' => 'WebpayPlusNormalController@init']
);
$router->post(
    '/webpayplus/normal/',
    ['as' => 'webpayplus_normal.return', 'uses' => 'WebpayPlusNormalController@return']
);
$router->post(
    '/webpayplus/normal/final',
    ['as' => 'webpayplus_normal.final', 'uses' => 'WebpayPlusNormalController@final']
);

// Webpay Oneclick Normal routes
$router->get(
    '/oneclick/normal/{paymentId}',
    ['as' => 'oneclick_normal.show', 'uses' => 'WebpayOneclickNormalController@showinscriptions']
);
$router->post(
    '/oneclick/normal/{paymentId}/inscribe',
    ['as' => 'oneclick_normal.inscribe', 'uses' => 'WebpayOneclickNormalController@initInscription']
);
$router->post(
    '/oneclick/normal/{paymentId}/confirm',
    ['as' => 'oneclick_normal.confirm', 'uses' => 'WebpayOneclickNormalController@confirmInscription']
);
$router->get(
    '/oneclick/normal/{paymentId}/{userId}/remove',
    ['as' => 'oneclick_normal.remove', 'uses' => 'WebpayOneclickNormalController@removeInscription']
);
$router->get(
    '/oneclick/normal/{paymentId}/{userId}',
    ['as' => 'oneclick_normal.authorize', 'uses' => 'WebpayOneclickNormalController@authorizePayment']
);
