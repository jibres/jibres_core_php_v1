<?php
namespace dash\utility\pay\api\idpay;


class bank
{

    public static $payment_response = [];


    public static function pay($_args = [])
    {

        $header =
        [
            'X-API-KEY: '. a($_args, 'apikey'),
            'Content-Type: application/json',
            // 'X-SANDBOX: 1', // test mode
        ];


        $default_args =
        [
            'amount'   => a($_args, 'amount'),
            'callback' => a($_args, 'callback'),
            'order_id' => a($_args, 'order_id'),
            'phone'    => a($_args, 'phone'),
        ];

        $args = json_encode($default_args);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        $getinfo = curl_getinfo($ch);

        curl_close($ch);

        $result = json_decode($result, true);

        if(isset($getinfo['http_code']) && $getinfo['http_code'] == 201)
        {
            // ok
        }
        else
        {
            if(isset($result['error_message']))
            {
                \dash\notif::error($result['error_message']);
                return false;
            }
            else
            {
                \dash\notif::error(T_("Bank error"));
                return false;
            }

        }

        if(!is_array($result))
        {
            \dash\notif::error(T_("Can not parse bank result!"));
            return false;
        }

        if(isset($result['error_message']))
        {
            \dash\notif::error($result['error_message']);
            return false;
        }

        self::$payment_response = $result;

        return $result;


    }


        /**
     * { function_description }
     *
     * @param      array  $_args  The arguments
     */
    public static function verify($_args = [])
    {

        $header =
        [
            'X-API-KEY: '. a($_args, 'apikey'),
            'Content-Type: application/json',
            // 'X-SANDBOX: 1', // test mode
        ];


        $default_args =
        [
            'id'       => a($_args, 'id'),
            'order_id' => a($_args, 'order_id'),
        ];

        $args = json_encode($default_args);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment/verify');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        $getinfo = curl_getinfo($ch);

        curl_close($ch);

        $result = json_decode($result, true);

        if(isset($getinfo['http_code']) && $getinfo['http_code'] == 200)
        {
            // ok
        }
        else
        {
            if(isset($result['error_message']))
            {
                \dash\notif::error($result['error_message']);
                return false;
            }
            else
            {
                \dash\notif::error(T_("Bank error"));
                return false;
            }
        }

        if(!is_array($result))
        {
            \dash\notif::error(T_("Can not parse bank result!"));
            return false;
        }

        if(isset($result['error_message']))
        {
            \dash\notif::error($result['error_message']);
            return false;
        }

        self::$payment_response = $result;

        return $result;

    }


}
?>