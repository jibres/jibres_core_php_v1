<?php
namespace dash\utility\pay\api\idpay;


class go
{

    public static function bank()
    {
        if(!\dash\setting\idpay::get('status'))
        {
            \dash\log::set('pay:idpay:status:false');
            \dash\notif::error(T_("The idpay payment on this service is locked"));
            return \dash\utility\pay\setting::turn_back();
        }

        if(!\dash\setting\idpay::get('apikey'))
        {
            \dash\log::set('pay:idpay:api:not:set');
            \dash\notif::error(T_("The idpay payment api not set"));
            return \dash\utility\pay\setting::turn_back();
        }

        $idpay = [];

        $idpay['apikey']          = \dash\setting\idpay::get('apikey');


        if(\dash\setting\idpay::get('callback'))
        {
            $idpay['callback'] = \dash\setting\idpay::get('callback');
        }
        else
        {
            $idpay['callback'] = \dash\utility\pay\setting::get_callbck_url('idpay');
        }

        // change rial to toman
        // but the plus is toman
        // need less to *10 the plus
        $idpay['amount'] = (string) floatval(\dash\utility\pay\setting::getAmount()) * 10;

        //START TRANSACTION BY CONDITION REQUEST
        $transaction_id = \dash\utility\pay\setting::get_id();

        if(!$transaction_id)
        {
            return \dash\utility\pay\setting::turn_back();
        }

        // set in this step and check in other step
        // $idpay['specialPaymentId'] = $transaction_id;
        $idpay['order_id'] = $transaction_id;

        // new feature
        // $idpay['mobile']          = null;
        // $idpay['description']     = null;
        // $idpay['validCardNumber'] = null;

        $token = \dash\utility\pay\api\idpay\bank::pay($idpay);

        \dash\utility\pay\setting::set_payment_response1(\dash\utility\pay\api\idpay\bank::$payment_response);

        if($token)
        {
            if(isset($token['id']) && isset($token['link']))
            {
                \dash\utility\pay\setting::set_condition('redirect');
                \dash\utility\pay\setting::set_banktoken($token['id']);
                \dash\utility\pay\setting::save();

                \dash\redirect::to($token['link']);
                return true;
            }
            else
            {
                \dash\utility\pay\setting::save();
                // \dash\utility\pay\setting::turn_back();
                return false;
            }

        }
        else
        {
            \dash\utility\pay\setting::save();
            // \dash\utility\pay\setting::turn_back();
            return false;
        }
    }
}
?>