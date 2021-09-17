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

        if(!\dash\setting\payping::get('token'))
        {
            \dash\log::set('pay:payping:token:not:set');
            \dash\notif::error(T_("The payping payment token not set"));
            return \dash\utility\pay\setting::turn_back();
        }


        $refId  = (string) \dash\request::request('refid');
        if(!$refId)
        {
            \dash\log::set('pay:payping:refid:not:set');
            \dash\notif::error(T_("The payping payment refId not set"));
            return \dash\utility\pay\setting::turn_back();
        }


        $clientrefid = (string) \dash\request::request('clientrefid');
        $code        = (string) \dash\request::request('code');


        \dash\utility\pay\setting::load_token($_token);

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

        if($clientrefid === (string) $transaction_id)
        {
            // ok
        }
        else
        {
            \dash\log::set('pay:payping:clientrefid:transactionid:not:equal');
            \dash\notif::error(T_("The payping ref id is invalid"));
            return \dash\utility\pay\setting::turn_back();
        }

        $payping          = [];
        $payping['token'] = \dash\setting\payping::get('token');
        $payping['refId'] = $refId;

        if(\dash\utility\pay\setting::getAmount())
        {
            $amount  = floatval(\dash\utility\pay\setting::getAmount());
        }
        else
        {
            \dash\utility\pay\setting::set_condition('error');
            \dash\utility\pay\setting::save();

            \dash\notif::error(T_("Your session is lost! We can not find amount"));
            return \dash\utility\pay\setting::turn_back();
        }

        $payping['amount'] = intval($amount);

        \dash\utility\pay\setting::set_condition('pending');
        \dash\utility\pay\setting::set_payment_response2(\dash\request::request());
        \dash\utility\pay\setting::save(true);

        $is_ok = \dash\utility\pay\api\payping\bank::verify($payping);

        $payment_response = \dash\utility\pay\api\payping\bank::$payment_response;

        \dash\utility\pay\setting::set_payment_response3($payment_response);

        if($is_ok)
        {
            if(intval($is_ok) === intval($amount))
            {
                \dash\utility\pay\verify::bank_ok($amount, $transaction_id);

                return \dash\utility\pay\setting::turn_back();
            }
            else
            {
                return \dash\utility\pay\verify::bank_error('verify_error');
            }
        }
        else
        {
            return \dash\utility\pay\verify::bank_error('verify_error');
        }

    }
}
?>