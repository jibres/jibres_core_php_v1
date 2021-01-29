<?php
namespace dash\utility\pay\api\idpay;


class back
{

    public static function verify($_token)
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

        $status   = \dash\request::request('status');
        $track_id = \dash\request::request('track_id');
        $id       = \dash\request::request('id');
        $order_id = \dash\request::request('order_id');

        if(!$id)
        {
            \dash\log::set('pay:idpay:id:verify:not:found');
            \dash\notif::error(T_("The idpay payment id not set"));
            return \dash\utility\pay\setting::turn_back();
        }

        \dash\utility\pay\setting::load_banktoken($_token, $id, 'idpay');

        if(\dash\utility\pay\setting::get_id())
        {
            $transaction_id  = \dash\utility\pay\setting::get_id();
        }
        else
        {
            \dash\log::set('pay:idpay:transaction_id:not:found:verify');
            \dash\notif::error(T_("Your session is lost! We can not find your transaction"));
            return \dash\utility\pay\setting::turn_back();
        }

        $idpay             = [];
        $idpay['apikey']   = \dash\setting\idpay::get('apikey');
        $idpay['order_id'] = $transaction_id;
        $idpay['id']       = $id;

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
        \dash\utility\pay\setting::set_payment_response2(\dash\request::request());
        \dash\utility\pay\setting::save(true);

        if(intval($status) === 10)
        {
            $is_ok = \dash\utility\pay\api\idpay\bank::verify($idpay);

            $payment_response = \dash\utility\pay\api\idpay\bank::$payment_response;

            \dash\utility\pay\setting::set_payment_response3($payment_response);

            if(isset($is_ok['status']) && intval($is_ok['status']) === 100)
            {
                if(isset($is_ok['amount']) && floatval($is_ok['amount']) === floatval($amount) && isset($is_ok['order_id']) && floatval($is_ok['order_id']) === floatval($transaction_id))
                {

                    \dash\utility\pay\verify::bank_ok($amount /10, $transaction_id);

                    return \dash\utility\pay\setting::turn_back();
                }
                else
                {
                    \dash\log::set('pay:idpay:amount:not:found:verify', ['amount' => $amount, 'bankAmount' => $is_ok['amount']]);
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