<?php
namespace dash\utility\pay\api\sep;


class back
{

    public static function verify($_token)
    {
        if(!\dash\setting\sep::get('status'))
        {
            \dash\log::set('pay:sep:status:false');
            \dash\notif::error(T_("The sep payment on this service is locked"));
            return \dash\utility\pay\setting::turn_back();
        }

        if(!\dash\setting\sep::get('MID'))
        {
            \dash\log::set('pay:sep:MID:null');
            \dash\notif::error(T_("The sep payment MID not set"));
            return \dash\utility\pay\setting::turn_back();
        }


        $State     = (string) \dash\request::request('State');
        $StateCode = (string) \dash\request::request('StateCode');
        $ResNum    = (string) \dash\request::request('ResNum');
        $MID       = (string) \dash\request::request('MID');
        $RefNum    = (string) \dash\request::request('RefNum');
        $CID       = (string) \dash\request::request('CID');
        $TRACENO   = (string) \dash\request::request('TRACENO');
        $SecurePan = (string) \dash\request::request('SecurePan');

        if(!$ResNum)
        {
            \dash\log::set('pay:sep:ResNum:verify:not:found');
            \dash\notif::error(T_("The sep payment ResNum not set"));
            return \dash\utility\pay\setting::turn_back();
        }


        \dash\utility\pay\setting::load_banktoken_transaction_id($_token, $ResNum, 'sep');

        $transaction_id  = \dash\utility\pay\setting::get_id();

        if(!$transaction_id)
        {
            \dash\log::set('pay:sep:SESSION:transaction_id:not:found');
            \dash\notif::error(T_("Your session is lost! We can not find your transaction"));
            return \dash\utility\pay\setting::turn_back();
        }

        $amount_SESSION  = floatval(\dash\utility\pay\setting::getAmount()) * 10;

        if(!$amount_SESSION)
        {
            \dash\log::set('pay:sep:SESSION:amount:not:found');
            \dash\notif::error(T_("Your session is lost! We can not find amount"));
            return \dash\utility\pay\setting::turn_back();
        }

        $sep             = [];
        $sep['RefNum']   = $RefNum;
        $sep['Amount']   = $amount_SESSION;

        $sep['MID']      = \dash\setting\sep::get('MID');
        $sep['Username'] = \dash\setting\sep::get('MID');
        $sep['Password'] = \dash\setting\sep::get('Password');

        \dash\utility\pay\setting::set_condition('pending');
        \dash\utility\pay\setting::set_payment_response2(\dash\request::request());
        \dash\utility\pay\setting::save(true);


        if($State == "OK")
        {

            $is_ok = \dash\utility\pay\api\sep\bank::verify($sep);

            $payment_response = \dash\utility\pay\api\sep\bank::$payment_response;

            \dash\utility\pay\setting::set_payment_response3($payment_response);

            if($is_ok)
            {
                \dash\utility\pay\verify::bank_ok($amount_SESSION, $transaction_id);

                return \dash\utility\pay\setting::turn_back();
            }
            else
            {
                $is_reverse = \dash\utility\pay\api\sep\bank::reverse($sep);

                $payment_response = \dash\utility\pay\api\sep\bank::$payment_response;
                \dash\utility\pay\setting::set_payment_response4($payment_response);

                if($is_reverse)
                {
                    return \dash\utility\pay\verify::bank_error('verify_error');
                }
                else
                {
                    \dash\log::set('sepBankBadBug', ['code' => $transaction_id]);
                    return \dash\utility\pay\verify::bank_error('verify_error');
                }
            }
        }
        else
        {
            return \dash\utility\pay\verify::bank_error('error');
        }
    }
}
?>
