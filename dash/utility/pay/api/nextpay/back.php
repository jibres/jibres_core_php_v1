<?php
namespace dash\utility\pay\api\nextpay;


class back
{

    public static function verify($_token)
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


        $trans_id  = strval(\dash\request::request('trans_id'));
        $order_id  = strval(\dash\request::request('order_id'));
        $amount    = strval(\dash\request::request('amount'));
        $np_status = strval(\dash\request::request('np_status'));


        if(!$trans_id)
        {
            \dash\log::set('pay:nextpay:trans_id:verify:not:found');
            \dash\notif::error(T_("The nextpay payment trans_id not set"));
            return \dash\utility\pay\setting::turn_back();
        }

        if(!$amount)
        {
            \dash\log::set('pay:nextpay:amount:verify:not:found');
            \dash\notif::error(T_("The nextpay payment amount not set"));
            return \dash\utility\pay\setting::turn_back();
        }

        if(!$order_id)
        {
            \dash\log::set('pay:nextpay:order_id:verify:not:found');
            \dash\notif::error(T_("The nextpay payment order_id not set"));
            return \dash\utility\pay\setting::turn_back();
        }



        \dash\utility\pay\setting::load_banktoken($_token, $trans_id, 'nextpay');

        if(\dash\utility\pay\setting::get_id())
        {
            $transaction_id  = \dash\utility\pay\setting::get_id();
        }
        else
        {
            \dash\log::set('pay:nextpay:transaction_id:not:found:verify');
            \dash\notif::error(T_("Your session is lost! We can not find your transaction"));
            return \dash\utility\pay\setting::turn_back();
        }


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



        $nextpay             = [];

        $nextpay['api_key']  = \dash\setting\nextpay::get('apikey');
        $nextpay['trans_id'] = $trans_id;
        $nextpay['currency'] = 'IRR'; // rial
        $nextpay['amount']   = $amount;


        \dash\utility\pay\setting::set_condition('pending');
        \dash\utility\pay\setting::set_payment_response2(\dash\request::request());
        \dash\utility\pay\setting::save(true);


        $is_ok = \dash\utility\pay\api\nextpay\bank::verify($nextpay);

        $payment_response = \dash\utility\pay\api\nextpay\bank::$payment_response;

        \dash\utility\pay\setting::set_payment_response3($payment_response);

        if($is_ok)
        {
            if(isset($is_ok['amount']) && floatval($is_ok['amount']) === floatval($amount) && isset($is_ok['order_id']) && floatval($is_ok['order_id']) === floatval($transaction_id))
            {
                \dash\utility\pay\verify::bank_ok($amount /10, $transaction_id);
                return \dash\utility\pay\setting::turn_back();
            }
            else
            {
                \dash\log::set('pay:nextpay:amount:not:found:verify', ['amount' => $amount, 'bankAmount' => $is_ok['amount']]);
                \dash\notif::error(T_("Your session is lost! We can not find amount"));
                return \dash\utility\pay\setting::turn_back();
            }
        }
        else
        {
            return \dash\utility\pay\verify::bank_error('verify_error');
        }

    }
}
?>