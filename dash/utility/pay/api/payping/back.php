<?php
namespace dash\utility\pay\api\payping;


class back
{

    public static function verify($_token)
    {
        if(!\dash\setting\payping::get('status'))
        {
            \dash\log::set('pay:payping:status:false');
            \dash\notif::error(T_("The payping payment on this service is locked"));
            return \dash\utility\pay\setting::turn_back();
        }

        if(!\dash\setting\payping::get('api'))
        {
            \dash\log::set('pay:payping:api:not:set');
            \dash\notif::error(T_("The payping payment api not set"));
            return \dash\utility\pay\setting::turn_back();
        }


        $token  = (string) \dash\request::request('token');
        $status = (string) \dash\request::request('status');

        // old version
        // $transId      = (string) \dash\request::request('transId');
        // $description  = (string) \dash\request::request('description');
        // $factorNumber = (string) \dash\request::request('factorNumber');
        // $cardNumber   = (string) \dash\request::request('cardNumber');
        // $message      = (string) \dash\request::request('message');

        // if(!$status)
        // {
        //     \dash\log::set('pay:payping:status:verify:not:found');
        //     \dash\notif::error(T_("The payping payment status not set"));
        //     return \dash\utility\pay\setting::turn_back();
        // }

        if(!$token)
        {
            \dash\log::set('pay:payping:token:verify:not:found');
            \dash\notif::error(T_("The payping payment token not set"));
            return \dash\utility\pay\setting::turn_back();
        }

        \dash\utility\pay\setting::load_banktoken($_token, $token, 'payping');

        if(\dash\utility\pay\setting::get_id())
        {
            $transaction_id  = \dash\utility\pay\setting::get_id();
        }
        else
        {
            \dash\log::set('pay:payping:transaction_id:not:found:verify');
            \dash\notif::error(T_("Your session is lost! We can not find your transaction"));
            return \dash\utility\pay\setting::turn_back();
        }

        $payping          = [];
        $payping['api']   = \dash\setting\payping::get('api');
        $payping['token'] = $token;

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

        if(intval($status) === 1)
        {
            $is_ok = \dash\utility\pay\api\payping\bank::verify($payping);

            $payment_response = \dash\utility\pay\api\payping\bank::$payment_response;

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
                    \dash\log::set('pay:payping:amount:not:found:verify', ['amount' => $amount, 'bankAmount' => $is_ok['amount']]);
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