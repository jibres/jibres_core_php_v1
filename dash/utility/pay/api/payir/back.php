<?php
namespace dash\utility\pay\api\payir;


class back
{

    public static function verify($_token)
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


        $token  = isset($_REQUEST['token'])        ? (string) $_REQUEST['token']         : null;
        $status = isset($_REQUEST['status'])       ? (string) $_REQUEST['status']        : null;

        // old version
        // $transId      = isset($_REQUEST['transId'])        ? (string) $_REQUEST['transId']         : null;
        // $description  = isset($_REQUEST['description'])    ? (string) $_REQUEST['description']     : null;
        // $factorNumber = isset($_REQUEST['factorNumber'])   ? (string) $_REQUEST['factorNumber']    : null;
        // $cardNumber   = isset($_REQUEST['cardNumber'])     ? (string) $_REQUEST['cardNumber']      : null;
        // $message      = isset($_REQUEST['message'])        ? (string) $_REQUEST['message']         : null;

        // if(!$status)
        // {
        //     \dash\log::set('pay:payir:status:verify:not:found');
        //     \dash\notif::error(T_("The payir payment status not set"));
        //     return \dash\utility\pay\setting::turn_back();
        // }

        if(!$token)
        {
            \dash\log::set('pay:payir:token:verify:not:found');
            \dash\notif::error(T_("The payir payment token not set"));
            return \dash\utility\pay\setting::turn_back();
        }

        \dash\utility\pay\setting::load_banktoken($_token, $token, 'payir');

        if(\dash\utility\pay\setting::get_id())
        {
            $transaction_id  = \dash\utility\pay\setting::get_id();
        }
        else
        {
            \dash\log::set('pay:payir:transaction_id:not:found:verify');
            \dash\notif::error(T_("Your session is lost! We can not find your transaction"));
            return \dash\utility\pay\setting::turn_back();
        }

        $payir          = [];
        $payir['api']   = \dash\setting\payir::get('api');
        $payir['token'] = $token;

        if(\dash\utility\pay\setting::getAmount())
        {
            $amount  = floatval(\dash\utility\pay\setting::getAmount()) * 10;
        }
        else
        {

            \dash\utility\pay\setting::set_condition('error');
            \dash\utility\pay\setting::save();

            \dash\notif::error(T_("Your session is lost! We can not find amount"));
            return \dash\utility\pay\setting::turn_back();
        }


        \dash\utility\pay\setting::set_condition('pending');
        \dash\utility\pay\setting::set_payment_response2($_REQUEST);
        \dash\utility\pay\setting::save(true);

        if(intval($status) === 1)
        {
            $is_ok = \dash\utility\pay\api\payir\bank::verify($payir);

            $payment_response = \dash\utility\pay\api\payir\bank::$payment_response;

            \dash\utility\pay\setting::set_payment_response3($payment_response);

            if(isset($is_ok['status']) && intval($is_ok['status']) === 1)
            {
                if(isset($is_ok['amount']) && floatval($is_ok['amount']) === floatval($amount) && isset($is_ok['factorNumber']) && floatval($is_ok['factorNumber']) === floatval($transaction_id))
                {

                    \dash\utility\pay\verify::bank_ok($amount /10, $transaction_id);

                    return \dash\utility\pay\setting::turn_back();
                }
                else
                {
                    \dash\log::set('pay:payir:amount:not:found:verify', ['amount' => $amount, 'bankAmount' => $is_ok['amount']]);
                    \dash\notif::error(T_("Your session is lost! We can not find amount"));
                    return \dash\utility\pay\setting::turn_back();
                }
            }
            else
            {
                return \dash\utility\pay\verify::bank_error('verify_error');
            }
        }
        else
        {
            return \dash\utility\pay\verify::bank_error('error');
        }
    }
}
?>