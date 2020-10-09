<?php
namespace dash\utility\pay\api\parsian;


class back
{

    public static function verify($_token)
    {
        if(!\dash\setting\parsian::get('status'))
        {
            \dash\log::set('pay:parsian:status:false');
            \dash\notif::error(T_("The parsian payment on this service is locked"));
            return \dash\utility\pay\setting::turn_back();
        }

        if(!\dash\setting\parsian::get('LoginAccount'))
        {
            \dash\log::set('pay:parsian:LoginAccount:not:set');
            \dash\notif::error(T_("The parsian payment LoginAccount not set"));
            return \dash\utility\pay\setting::turn_back();
        }

        $Token          = (string) \dash\request::request('Token');
        $OrderId        = (string) \dash\request::request('OrderId');
        $status         = (string) \dash\request::request('status');
        $TerminalNo     = (string) \dash\request::request('TerminalNo');
        $RRN            = (string) \dash\request::request('RRN');
        $TspToken       = (string) \dash\request::request('TspToken');
        $HashCardNumber = (string) \dash\request::request('HashCardNumber');
        $Amount         = (string) \dash\request::request('Amount');
        $Amount         = str_replace(',', '', $Amount);

        if(!$Token)
        {
            \dash\log::set('pay:parsian:Token:verify:not:found');
            \dash\notif::error(T_("The parsian payment Token not set"));
            return \dash\utility\pay\setting::turn_back();
        }

        \dash\utility\pay\setting::load_banktoken($_token, $Token, 'parsian');

        $transaction_id  = \dash\utility\pay\setting::get_id();

        if(!$transaction_id)
        {
            \dash\log::set('pay:parsian:SESSION:transaction_id:not:found');
            \dash\notif::error(T_("Your session is lost! We can not find your transaction"));
            return \dash\utility\pay\setting::turn_back();
        }

        \dash\utility\pay\setting::set_condition('pending');
        \dash\utility\pay\setting::set_payment_response2(\dash\request::request());
        \dash\utility\pay\setting::save(true);

        $parsian                 = [];
        $parsian['LoginAccount'] = \dash\setting\parsian::get('LoginAccount');
        $parsian['Token']        = $Token;

        $Amount_SESSION  = floatval(\dash\utility\pay\setting::getAmount());

        if(!$Amount_SESSION)
        {
            \dash\log::set('pay:parsian:SESSION:amount:not:found');
            \dash\notif::error(T_("Your session is lost! We can not find amount"));
            return \dash\utility\pay\setting::turn_back();
        }

        if($Amount_SESSION != (floatval($Amount) / 10))
        {
            \dash\log::set('pay:parsian:Amount_SESSION:amount:is:not:equals');
            \dash\notif::error(T_("Your session is lost! We can not find amount"));
            return \dash\utility\pay\setting::turn_back();
        }

        if($status === '0' && intval($Token) > 0)
        {
            $is_ok = \dash\utility\pay\api\parsian\bank::verify($parsian);

            $payment_response = \dash\utility\pay\api\parsian\bank::$payment_response;

            \dash\utility\pay\setting::set_payment_response3($payment_response);

            if($is_ok)
            {
                \dash\utility\pay\verify::bank_ok($Amount_SESSION /10, $transaction_id);

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