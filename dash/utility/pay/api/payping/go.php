<?php
namespace dash\utility\pay\api\payping;


class go
{

    public static function bank()
    {
        if(!\dash\setting\payping::get('status'))
        {
            \dash\log::set('pay:payping:status:false');
            \dash\notif::error(T_("The payping payment on this service is locked"));
            return \dash\utility\pay\setting::turn_back();
        }

        if(!\dash\setting\payping::get('token'))
        {
            \dash\log::set('pay:payping:token:not:set');
            \dash\notif::error(T_("The payping payment token not set"));
            return \dash\utility\pay\setting::turn_back();
        }

        $payping = [];

        $payping['token']          = \dash\setting\payping::get('token');


        if(\dash\setting\payping::get('returnUrl'))
        {
            $payping['returnUrl'] = \dash\setting\payping::get('returnUrl');
        }
        else
        {
            $payping['returnUrl'] = \dash\utility\pay\setting::get_callbck_url('payping');
        }

        // change rial to toman
        // but the plus is toman
        // need less to *10 the plus
        $payping['Amount'] = (string) floatval(\dash\utility\pay\setting::getAmount());

        //START TRANSACTION BY CONDITION REQUEST
        $transaction_id = \dash\utility\pay\setting::get_id();

        if(!$transaction_id)
        {
            return \dash\utility\pay\setting::turn_back();
        }

        // set in this step and check in other step
        $payping['clientRefId'] = $transaction_id;

        // $payping['Description']     = null;
        // $payping['payerIdentity'] = null;

        $token = \dash\utility\pay\api\payping\bank::pay($payping);

        \dash\utility\pay\setting::set_payment_response1(\dash\utility\pay\api\payping\bank::$payment_response);

        if($token)
        {
            \dash\utility\pay\setting::set_condition('redirect');
            \dash\utility\pay\setting::set_banktoken($token);

            \dash\utility\pay\setting::save();

            $redirect_url = "https://api.payping.ir/v2/pay/gotoipg/". $token;

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