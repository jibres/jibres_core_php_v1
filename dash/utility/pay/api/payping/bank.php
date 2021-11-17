<?php
namespace dash\utility\pay\api\payping;


class bank
{

    public static $payment_response = [];


    public static function pay($_args = [])
    {

        $pay_args =
        [
            'clientRefId'   => array_key_exists('clientRefId', $_args) ? $_args['clientRefId'] : null,
            'payerIdentity' => array_key_exists('payerIdentity', $_args) ? $_args['payerIdentity'] : null,
            'Amount'        => array_key_exists('Amount', $_args) ? $_args['Amount'] : null,
            'Description'   => array_key_exists('Description', $_args) ? $_args['Description'] : null,
            'returnUrl'     => array_key_exists('returnUrl', $_args) ? $_args['returnUrl'] : null,
        ];

        $curl_headers =
        [
            "accept: application/json",
            "authorization: Bearer " . $_args['token'],
            "cache-control: no-cache",
            "content-type: application/json",
        ];


        $pay_args = json_encode($pay_args);

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, 'https://api.payping.ir/v2/pay');

        curl_setopt($handle, CURLOPT_ENCODING, "");
        curl_setopt($handle, CURLOPT_HTTPHEADER, $curl_headers);
        curl_setopt($handle, CURLOPT_MAXREDIRS, 10);
        curl_setopt($handle, CURLOPT_TIMEOUT, 45);
        curl_setopt($handle, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handle, CURLOPT_POSTFIELDS, $pay_args);

        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);

        $result = curl_exec($handle);
        $header = curl_getinfo($handle);
        $error  = curl_error($handle);

        curl_close($handle);

        $result = json_decode($result, true);

        self::$payment_response = $result;

        if(isset($header['http_code']) && $header['http_code'] === 200)
        {
            if(isset($result['code']) && isset($result['code']))
            {
                return $result['code'];
            }
            else
            {
                \dash\notif::error(T_("Result code not found in payping response!"));
                return false;
            }
        }
        elseif(isset($header['http_code']) && in_array($header['http_code'], [400, 401, 500, 503, 403, 404]))
        {
            \dash\notif::error(T_("Payping error :val. Please contact to payping support", ['val' => \dash\fit::number($header['http_code'])]));
            return false;
        }
        else
        {
            if(isset($result['Error']))
            {
                \dash\notif::error($result['Error']);
                return false;
            }
            else
            {
                \dash\notif::error(T_("Unkown error! Please contact to payping support"));
                return false;
            }
        }


        return false;

    }


    /**
     * { function_description }
     *
     * @param      array  $_args  The arguments
     */
    public static function verify($_args = [])
    {
        $pay_args =
        [
            'refId'   => array_key_exists('refId', $_args) ? $_args['refId'] : null,
            'amount' => array_key_exists('amount', $_args) ? $_args['amount'] : null,
        ];

        $pay_args = json_encode($pay_args);

        $curl_headers =
        [
            "accept: application/json",
            "authorization: Bearer " . $_args['token'],
            "cache-control: no-cache",
            "content-type: application/json",
        ];

        $handle   = curl_init();

        curl_setopt($handle, CURLOPT_URL, 'https://api.payping.ir/v2/pay/verify');
        curl_setopt($handle, CURLOPT_ENCODING, "");
        curl_setopt($handle, CURLOPT_HTTPHEADER, $curl_headers);
        curl_setopt($handle, CURLOPT_MAXREDIRS, 10);
        curl_setopt($handle, CURLOPT_TIMEOUT, 45);
        curl_setopt($handle, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($handle, CURLOPT_POSTFIELDS, $pay_args);

        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);

        $result = curl_exec($handle);
        $header = curl_getinfo($handle);
        $error  = curl_error($handle);

        $result = json_decode($result, true);

        self::$payment_response = $result;

        if(isset($header['http_code']) && $header['http_code'] === 200)
        {
            if(isset($result['amount']))
            {
                return $result['amount'];
            }
            else
            {
                return false;
            }
        }
        else
        {
            if(isset($result['Error']))
            {
                \dash\notif::error($result['Error']);
                return false;
            }
        }


        return false;


    }

}
?>