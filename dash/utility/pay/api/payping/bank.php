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
        $header = curl_getinfo( $handle );
        $error    = curl_error( $handle );

        curl_close($handle);

        $result = json_decode($result, true);

        self::$payment_response = $result;

        if(isset($header['http_code']) && $header['http_code'] === 200)
        {
            if(isset($result['code']) && isset($result['code']))
            {
                return $result['code'];
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




//     if( $err ){
//         $msg = 'کد خطا: CURL#' . $er;
//         $erro = 'در اتصال به درگاه مشکلی پیش آمد.';
//         return false;
//     }else{
//         if( $header['http_code'] == 200 ){
//             $response = json_decode( $response, true );
//             if( isset( $response ) and $response != '' ){
//                 $response = $response['code'];
//                 /* ارسال به درگاه پرداخت با استفاده از کد ارجاع */
//                 $GoToIPG = 'https://api.payping.ir/v2/pay/gotoipg/' . $response;
//                 header( 'Location: ' . $GoToIPG );
//             }else{
//                 $msg = 'تراکنش ناموفق بود - شرح خطا: عدم وجود کد ارجاع';
//             }
//         }elseif($header['http_code'] == 400){
//             $msg = 'تراکنش ناموفق بود، شرح خطا: ' . $response;
//         }else{
//             $msg = 'تراکنش ناموفق بود، شرح خطا: ' . $header['http_code'];
//         }
//     }
// }catch(Exception $e){
//     $msg = 'تراکنش ناموفق بود، شرح خطا سمت برنامه شما: ' . $e->getMessage();
// }


    }


        /**
     * { function_description }
     *
     * @param      array  $_args  The arguments
     */
    public static function verify($_args = [])
    {
        $default_args =
        [
            'api'   => array_key_exists('api', $_args) ? $_args['api'] : null,
            'token' => array_key_exists('token', $_args) ? $_args['token'] : null,
        ];

        $default_args = http_build_query($default_args);

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, 'https://pay.ir/pg/verify');
        curl_setopt($handle, CURLOPT_POSTFIELDS, $default_args);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($handle);
        curl_close($handle);

        $result = json_decode($result, true);

        self::$payment_response = $result;

        if(isset($result['status']) && intval($result['status']) === 1)
        {
            return $result;
        }

        if(array_key_exists('status', $result))
        {
            \dash\notif::error(self::msg($result['status'], 'verify'));
        }

        return false;
    }


    /**
     * set msg
     *
     * @param      <type>  $_status  The status
     */
    public static function msg($_status, $_type = 'send')
    {
        $msg = null;
        if($_type === 'send')
        {
            switch ($_status)
            {
                case '-1':
                case -1:
                    $msg = "ارسال api الزامی می باشد";
                    break;

                case '-2':
                case -2:
                    $msg = "ارسال مبلغ تراکنش الزامی می باشد";
                    break;

                case '-3':
                case -3:
                    $msg = "مبلغ تراکنش باید به صورت عددی باشد";
                    break;

                case '-4':
                case -4:
                    $msg = "مبلغ تراکنش نباید کمتر از 1000 باشد";
                    break;

                case '-5':
                case -5:
                    $msg = "ارسال redirect الزامی می باشد";
                    break;

                case '-6':
                case -6:
                    $msg = "درگاه پرداختی با api ارسالی یافت نشد و یا غیر فعال می باشد";
                    break;

                case '-7':
                case -7:
                    $msg = "فروشنده غیر فعال می باشد";
                    break;

                case '-8':
                case -8:
                    $msg = "آدرس بازگشتی با آدرس درگاه پرداخت ثبت شده همخوانی ندارد";
                    break;

                case '0':
                case 0:
                    $msg = "در حال حاضر درگاه پرداخت قطع می باشد. به زودی مشکل برطرف خواهد شد";
                    break;

                default:
                case 'failed':
                    $msg = "تراکنش با خطا مواجه شد";
                    break;
            }
        }
        elseif($_type === 'verify')
        {

            switch ($_status)
            {
                case '-1':
                case -1:
                    $msg = "ارسال api الزامی می باشد";
                    break;

                case '-2':
                case -2:
                    $msg = "ارسال transId الزامی می باشد";
                    break;

                case '-3':
                case -3:
                    $msg = "درگاه پرداختی با api ارسالی یافت نشد و یا غیر فعال می باشد";
                    break;

                case '-4':
                case -4:
                    $msg = "فروشنده غیر فعال می باشد";
                    break;

                case '-5':
                case -5:
                default:
                    $msg = "تراکنش با خطا مواجه شده است";
                    break;
            }
        }

        return $msg;
    }
}
?>