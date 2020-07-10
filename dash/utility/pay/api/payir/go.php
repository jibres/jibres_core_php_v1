<?php
namespace dash\utility\pay\api\payir;


class go
{

    public static function bank()
    {
        if(!\dash\setting\payir::get('status'))
        {
            \dash\log::set('pay:payir:status:false');
            \dash\notif::error(T_("The payir payment on this service is locked"));
            return \dash\utility\pay\setting::turn_back();
        }

        if(!\dash\setting\payir::get('api'))
        {
            \dash\log::set('pay:payir:api:not:set');
            \dash\notif::error(T_("The payir payment api not set"));
            return \dash\utility\pay\setting::turn_back();
        }

        $payir = [];

        $payir['api']          = \dash\setting\payir::get('api');

        if(\dash\setting\payir::get('redirect'))
        {
            $payir['redirect'] = \dash\setting\payir::get('redirect');
        }
        else
        {
            $payir['redirect'] = \dash\utility\pay\setting::get_callbck_url('payir');
        }

        // change rial to toman
        // but the plus is toman
        // need less to *10 the plus
        $payir['amount'] = (string) floatval(\dash\utility\pay\setting::get_plus()) * 10;

        //START TRANSACTION BY CONDITION REQUEST
        $transaction_id = \dash\utility\pay\setting::get_id();

        if(!$transaction_id)
        {
            return \dash\utility\pay\setting::turn_back();
        }

        // set in this step and check in other step
        // $payir['specialPaymentId'] = $transaction_id;
        $payir['factorNumber'] = $transaction_id;

        // new feature
        // $payir['mobile']          = null;
        // $payir['description']     = null;
        // $payir['validCardNumber'] = null;

        $token = \dash\utility\pay\api\payir\bank::pay($payir);

        \dash\utility\pay\setting::set_payment_response1(\dash\utility\pay\api\payir\bank::$payment_response);

        if($token)
        {
            \dash\utility\pay\setting::set_condition('redirect');
            \dash\utility\pay\setting::set_banktoken($token);

            \dash\utility\pay\setting::save();

            $redirect_url = "https://pay.ir/pg/". $token;
            \dash\redirect::to($redirect_url);
            return true;
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