<?php
namespace dash\utility\pay\api\zarinpal;


class go
{

    public static function bank()
    {
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

        $zarinpal = [];
        $zarinpal['MerchantID'] = \dash\setting\zarinpal::get('MerchantID');

        if(\dash\setting\zarinpal::get('Description'))
        {
            $zarinpal['Description'] = \dash\setting\zarinpal::get('Description');
        }

        if(\dash\setting\zarinpal::get('CallbackURL'))
        {
            $zarinpal['CallbackURL'] = \dash\setting\zarinpal::get('CallbackURL');
        }
        else
        {
            $zarinpal['CallbackURL'] = \dash\utility\pay\setting::get_callbck_url('zarinpal');
        }

        $zarinpal['Amount'] = \dash\utility\pay\setting::getAmount();

        if(isset($_options['mobile']))
        {
            $zarinpal['Mobile'] = $_options['mobile'];
        }


        if(isset($_options['email']))
        {
            $zarinpal['Email'] = $_options['email'];
        }


        //START TRANSACTION BY CONDITION REQUEST
        $transaction_id = \dash\utility\pay\setting::get_id();

        if(!$transaction_id)
        {
            return \dash\utility\pay\setting::turn_back();
        }

        $redirect = \dash\utility\pay\api\zarinpal\bank::pay($zarinpal);

        $payment_response = \dash\utility\pay\api\zarinpal\bank::$payment_response;
        \dash\utility\pay\setting::set_payment_response1($payment_response);

        if($redirect)
        {
            if(isset($payment_response->Authority))
            {
                \dash\utility\pay\setting::set_condition('redirect');
                \dash\utility\pay\setting::set_banktoken($payment_response->Authority);

                \dash\utility\pay\setting::save();

                // redirect to bank
                \dash\redirect::to($redirect);

                return true;
            }
            else
            {
                \dash\log::set('pay:zarinpal:Authority:not:set');
                \dash\notif::error(T_("Zarinpal payment Authority not found"));
                return \dash\utility\pay\setting::turn_back();
            }
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
