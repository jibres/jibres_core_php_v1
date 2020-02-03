<?php
namespace dash\utility\pay\api\irkish;


class go
{

    public static function bank()
    {
        if(!\dash\setting\irkish::get('status'))
        {
            \dash\log::set('pay:irkish:status:false');
            \dash\notif::error(T_("The irkish payment on this service is locked"));
            return \dash\utility\pay\setting::turn_back();
        }

        if(!\dash\setting\irkish::get('merchantId'))
        {
            \dash\log::set('pay:irkish:merchantId:not:set');
            \dash\notif::error(T_("The irkish payment merchantId not set"));
            return \dash\utility\pay\setting::turn_back();
        }

        $irkish = [];

        $irkish['paymentId']   = \dash\setting\irkish::get('paymentId');
        $irkish['Sha1']        = \dash\setting\irkish::get('Sha1');
        $irkish['merchantId']  = \dash\setting\irkish::get('merchantId');
        $irkish['description'] = \dash\setting\irkish::get('description');


        if(\dash\setting\irkish::get('revertURL'))
        {
            $irkish['revertURL'] = \dash\setting\irkish::get('revertURL');
        }
        else
        {
            $irkish['revertURL'] = \dash\utility\pay\setting::get_callbck_url('irkish');
        }

        // change rial to toman
        // but the plus is toman
        // need less to *10 the plus
        $irkish['amount'] = (string) (floatval(\dash\utility\pay\setting::get_plus()) * 10);

        $transaction_id = \dash\utility\pay\setting::get_id();

        if(!$transaction_id)
        {
            return \dash\utility\pay\setting::turn_back();
        }
        // set in this step and check in other step
        // $irkish['specialPaymentId'] = $transaction_id;
        $irkish['invoiceNo'] = $transaction_id;

        $token = \dash\utility\pay\api\irkish\bank::pay($irkish);

        \dash\utility\pay\setting::set_payment_response1(\dash\utility\pay\api\irkish\bank::$payment_response);

        if($token)
        {


            \dash\utility\pay\setting::set_condition('redirect');
            \dash\utility\pay\setting::set_banktoken($token);

            \dash\utility\pay\setting::save();

            // redirect to enter/redirect
            \dash\session::set('redirect_page_url', 'https://ikc.shaparak.ir/TPayment/Payment/index');
            \dash\session::set('redirect_page_method', 'post');
            \dash\session::set('redirect_page_args', ['token' => $token, 'merchantId' => \dash\setting\irkish::get('merchantId')]);
            \dash\session::set('redirect_page_title', T_("Redirect to iran kish payment"));
            \dash\session::set('redirect_page_button', T_("Redirect"));
            \dash\notif::direct();
            \dash\redirect::to(\dash\utility\pay\setting::get_callbck_url('redirect_page'));
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
