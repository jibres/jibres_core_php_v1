<?php
namespace dash\utility\pay\api\zarinpal;


class back
{

    public static function verify($_token)
    {
        if(!\dash\request::request('Authority') || !\dash\request::request('Status'))
        {
            return \dash\utility\pay\setting::turn_back();
        }

        if(!\dash\setting\zarinpal::get('status'))
        {
            \dash\log::set('pay:zarinpal:status:false');
            \dash\notif::error(T_("The zarinpal payment on this service is locked"));
            return \dash\utility\pay\setting::turn_back();
        }

        if(!\dash\setting\zarinpal::get('MerchantID'))
        {
            \dash\log::set('pay:zarinpal:MerchantID:not:set');
            \dash\notif::error(T_("The zarinpal payment MerchantID not set"));
            return \dash\utility\pay\setting::turn_back();
        }

        $zarinpal               = [];
        $zarinpal['MerchantID'] = \dash\setting\zarinpal::get('MerchantID');
        $zarinpal['Authority']  = \dash\request::request('Authority');

        \dash\utility\pay\setting::load_banktoken($_token, $zarinpal['Authority'], 'zarinpal');

        $transaction_id  = \dash\utility\pay\setting::get_id();

        if(!$transaction_id)
        {
            \dash\log::set('pay:zarinpal:SESSION:transaction_id:not:found');
            \dash\notif::error(T_("Your session is lost! We can not find your transaction"));
            return \dash\utility\pay\setting::turn_back();
        }


        \dash\utility\pay\setting::set_condition('pending');
        \dash\utility\pay\setting::set_payment_response2(\dash\request::request());
        \dash\utility\pay\setting::save(true);


        $zarinpal['Amount']  = \dash\utility\pay\setting::getAmount();

        if(\dash\request::request('Status') == 'NOK')
        {
            return \dash\utility\pay\verify::bank_error('cancel');
        }
        else
        {
            $is_ok = \dash\utility\pay\api\zarinpal\bank::verify($zarinpal);

            $payment_response = \dash\utility\pay\api\zarinpal\bank::$payment_response;

            \dash\utility\pay\setting::set_payment_response3($payment_response);

            if($is_ok)
            {
                \dash\utility\pay\verify::bank_ok($zarinpal['Amount'], $transaction_id);

                return \dash\utility\pay\setting::turn_back();
            }
            else
            {
               return \dash\utility\pay\verify::bank_error('verify_error');
            }
        }
    }
}
?>