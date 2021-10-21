<?php

namespace App\Http\Controllers;


use FFI\Exception;
use Illuminate\Http\Request;
use Openpay;
require_once '../vendor/autoload.php';
class PagoController extends Controller
{
    //
    public function procesar(Request $request){
        try {
            Openpay::setProductionMode(false);

            // the following line will generate an error because the
            // private key is empty. The exception generated will be
            // a OpenpayApiAuthError
            $openpay = Openpay::getInstance('mkonampxt6onh9ddekio', 'pk_80f9b25ee42c4549bc327649de298c64', 'MX');

            $customer = array(
                'name' => 'Jose Luis',
                'last_name' => 'Godinez Vazquez',
                'phone_number' => '',
                'email' => 'luis.vaz2702@gmail.com'
            );

            $chargeData = array(
                'method' => 'card',
                'source_id' => $_POST['token_id'],
                'currency' => 'MXN',
                'amount' => 200,
                'send_email' => true,
                'description' => 'Cargo inicial a mi merchant',
                'use_card_points' => false,
                'device_session_id' => $_POST['deviceIdHiddenFieldName'],
                'customer' => $customer);

            $charge = $openpay->charges->create($chargeData);
            return "List" . $charge;
             } catch (Exception $e) {
            error_log('Error on the script: ' . $e->getMessage(), 0);
        }
    }
}
