<?php
namespace dash\utility\pay\api\nextpay;


class go
{

    public static function bank()
    {
        if(!\dash\setting\nextpay::get('status'))
        {
            \dash\log::set('pay:nextpay:status:false');
            \dash\notif::error(T_("The nextpay payment on this service is locked"));
            return \dash\utility\pay\setting::turn_back();
        }

        if(!\dash\setting\nextpay::get('apikey'))
        {
            \dash\log::set('pay:nextpay:apikey:not:set');
            \dash\notif::error(T_("The nextpay payment apikey not set"));
            return \dash\utility\pay\setting::turn_back();
        }

        $nextpay                 = [];

        $nextpay['api_key']      = \dash\setting\nextpay::get('apikey');
        $nextpay['callback_uri'] = \dash\utility\pay\setting::get_callbck_url('nextpay');
        $nextpay['currency']     = 'IRR'; // rial
        $nextpay['auto_verify']  = 'no';


        // change rial to toman
        // but the plus is toman
        // need less to *10 the plus
        $nextpay['amount'] = (string) floatval(\dash\utility\pay\setting::getAmount()) * 10;

        //START TRANSACTION BY CONDITION REQUEST
        $transaction_id = \dash\utility\pay\setting::get_id();

        if(!$transaction_id)
        {
            return \dash\utility\pay\setting::turn_back();
        }

        // set in this step and check in other step
        $nextpay['order_id'] = $transaction_id;

        // new feature
        // $nextpay['customer_phone']     = null;
        // $nextpay['custom_json_fields'] = null;
        // $nextpay['allowed_card']       = null;

        $token = \dash\utility\pay\api\nextpay\bank::pay($nextpay);

        \dash\utility\pay\setting::set_payment_response1(\dash\utility\pay\api\nextpay\bank::$payment_response);

        if($token)
        {
            \dash\utility\pay\setting::set_condition('redirect');
            \dash\utility\pay\setting::set_banktoken($token);

            \dash\utility\pay\setting::save();

            $redirect_url = "https://nextpay.org/nx/gateway/payment/". $token;

            \dash\utility\pay\setting::before_redirect();
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