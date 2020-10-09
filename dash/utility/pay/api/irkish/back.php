<?php
namespace dash\utility\pay\api\irkish;


class back
{

    public static function verify($_token)
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


        $token         = (string) \dash\request::request('token');
        $merchantId    = (string) \dash\request::request('merchantId');
        $resultCode    = (string) \dash\request::request('resultCode');
        $paymentId     = (string) \dash\request::request('paymentId');
        $InvoiceNumber = (string) \dash\request::request('InvoiceNumber');
        $referenceId   = (string) \dash\request::request('referenceId');
        $amount        = (string) \dash\request::request('amount');
        $amount        = str_replace(',', '', $amount);

        if(!$token)
        {
            \dash\log::set('pay:irkish:token:verify:not:found');
            \dash\notif::error(T_("The irkish payment token not set"));
            return \dash\utility\pay\setting::turn_back();
        }

        if(!$resultCode)
        {
            \dash\log::set('pay:irkish:resultCode:verify:not:found');
            \dash\notif::error(T_("The irkish payment resultCode not set"));
            return \dash\utility\pay\setting::turn_back();
        }

        \dash\utility\pay\setting::load_banktoken($_token, $token, 'irkish');

        $transaction_id = \dash\utility\pay\setting::get_id();

        if(!$transaction_id)
        {
            \dash\log::set('pay:irkish:SESSION:transaction_id:not:found');
            \dash\notif::error(T_("Your session is lost! We can not find your transaction"));
            return \dash\utility\pay\setting::turn_back();
        }

        $irkish                    = [];
        $irkish['merchantId']      = \dash\setting\irkish::get('merchantId');
        $irkish['token']           = $token;
        $irkish['amount']          = $amount;
        $irkish['referenceNumber'] = (string) $referenceId;
        $irkish['sha1Key']         = \dash\setting\irkish::get('sha1');

        $amount_SESSION  = floatval(\dash\utility\pay\setting::getAmount());

        if(!$amount_SESSION)
        {
            \dash\log::set('pay:irkish:SESSION:amount:not:found');
            \dash\notif::error(T_("Your session is lost! We can not find amount"));
            return \dash\utility\pay\setting::turn_back();
        }

        \dash\utility\pay\setting::set_condition('pending');
        \dash\utility\pay\setting::set_amount_end($amount / 10);
        \dash\utility\pay\setting::set_payment_response2(\dash\request::request());
        \dash\utility\pay\setting::save(true);

        if(intval($resultCode) === 100)
        {

            $is_ok = \dash\utility\pay\api\irkish\bank::verify($irkish);

            $payment_response = \dash\utility\pay\api\irkish\bank::$payment_response;

            \dash\utility\pay\setting::set_payment_response3($payment_response);

            if($is_ok)
            {
                \dash\utility\pay\verify::bank_ok($amount /10, $transaction_id);

                return \dash\utility\pay\setting::turn_back();
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

