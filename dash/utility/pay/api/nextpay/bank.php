<?php
namespace dash\utility\pay\api\nextpay;


class bank
{

    public static $payment_response = [];


    public static function pay($_args = [])
    {

        $default_args =
        [
            'api_key'            => a($_args, 'api_key'),
            'callback_uri'       => a($_args, 'callback_uri'),
            'currency'           => a($_args, 'currency'),
            'auto_verify'        => a($_args, 'auto_verify'),
            'amount'             => a($_args, 'amount'),
            'order_id'           => a($_args, 'order_id'),
            'customer_phone'     => a($_args, 'customer_phone'),
            'custom_json_fields' => a($_args, 'custom_json_fields'),
            'allowed_card'       => a($_args, 'allowed_card'),

        ];

        $default_args = http_build_query($default_args);

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, 'https://nextpay.org/nx/gateway/token');
        curl_setopt($handle, CURLOPT_POSTFIELDS, $default_args);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($handle);
        curl_close($handle);


        self::$payment_response = $result;

        $result = json_decode($result, true);

        if(!is_array($result))
        {
            $result = [];
        }

        if(isset($result['code']) && intval($result['code']) === -1 && isset($result['trans_id']))
        {
            return $result['trans_id'];
        }

        if(array_key_exists('code', $result))
        {
            \dash\notif::error(self::msg($result['code']));
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
        $default_args =
        [
            'api_key'  => a($_args, 'api_key'),
            'currency' => a($_args, 'currency'),
            'amount'   => a($_args, 'amount'),
            'trans_id' => a($_args, 'trans_id'),
        ];

        $default_args = http_build_query($default_args);

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, 'https://nextpay.org/nx/gateway/verify');
        curl_setopt($handle, CURLOPT_POSTFIELDS, $default_args);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_POST, true);
        $result = curl_exec($handle);
        curl_close($handle);

        $result = json_decode($result, true);

        self::$payment_response = $result;

        if(isset($result['code']) && strval($result['code']) === '0')
        {
            return $result;
        }

        if(array_key_exists('code', $result))
        {
            \dash\notif::error(self::msg($result['code']));
        }

        return false;
    }


    /**
     * set msg
     *
     * @param      <type>  $_status  The status
     */
    public static function msg($_status)
    {
        $msg = null;
        switch ($_status)
        {
            case '0' : $msg = 'پرداخت تکمیل و با موفقیت انجام شده است'; break;
            case '-1' : $msg = 'منتظر ارسال تراکنش و ادامه پرداخت'; break;
            case '-2' : $msg = 'پرداخت رد شده توسط کاربر یا بانک'; break;
            case '-3' : $msg = 'پرداخت در حال انتظار جواب بانک'; break;
            case '-4' : $msg = 'پرداخت لغو شده است'; break;
            case '-20' : $msg = 'کد api_key ارسال نشده است'; break;
            case '-21' : $msg = 'کد trans_id ارسال نشده است'; break;
            case '-22' : $msg = 'مبلغ ارسال نشده'; break;
            case '-23' : $msg = 'لینک ارسال نشده'; break;
            case '-24' : $msg = 'مبلغ صحیح نیست'; break;
            case '-25' : $msg = 'تراکنش قبلا انجام و قابل ارسال نیست'; break;
            case '-26' : $msg = 'مقدار توکن ارسال نشده است'; break;
            case '-27' : $msg = 'شماره سفارش صحیح نیست'; break;
            case '-28' : $msg = 'مقدار فیلد سفارشی [custom_json_fields] از نوع json نیست'; break;
            case '-29' : $msg = 'کد بازگشت مبلغ صحیح نیست'; break;
            case '-30' : $msg = 'مبلغ کمتر از حداقل پرداختی است'; break;
            case '-31' : $msg = 'صندوق کاربری موجود نیست'; break;
            case '-32' : $msg = 'مسیر بازگشت صحیح نیست'; break;
            case '-33' : $msg = 'کلید مجوز دهی صحیح نیست'; break;
            case '-34' : $msg = 'کد تراکنش صحیح نیست'; break;
            case '-35' : $msg = 'ساختار کلید مجوز دهی صحیح نیست'; break;
            case '-36' : $msg = 'شماره سفارش ارسال نشد است'; break;
            case '-37' : $msg = 'شماره تراکنش یافت نشد'; break;
            case '-38' : $msg = 'توکن ارسالی موجود نیست'; break;
            case '-39' : $msg = 'کلید مجوز دهی موجود نیست'; break;
            case '-40' : $msg = 'کلید مجوزدهی مسدود شده است'; break;
            case '-41' : $msg = 'خطا در دریافت پارامتر، شماره شناسایی صحت اعتبار که از بانک ارسال شده موجود نیست'; break;
            case '-42' : $msg = 'سیستم پرداخت دچار مشکل شده است'; break;
            case '-43' : $msg = 'درگاه پرداختی برای انجام درخواست یافت نشد'; break;
            case '-44' : $msg = 'پاسخ دریاف شده از بانک نامعتبر است'; break;
            case '-45' : $msg = 'سیستم پرداخت غیر فعال است'; break;
            case '-46' : $msg = 'درخواست نامعتبر'; break;
            case '-47' : $msg = 'کلید مجوز دهی یافت نشد [حذف شده]'; break;
            case '-48' : $msg = 'نرخ کمیسیون تعیین نشده است'; break;
            case '-49' : $msg = 'تراکنش مورد نظر تکراریست'; break;
            case '-50' : $msg = 'حساب کاربری برای صندوق مالی یافت نشد'; break;
            case '-51' : $msg = 'شناسه کاربری یافت نشد'; break;
            case '-52' : $msg = 'حساب کاربری تایید نشده است'; break;
            case '-60' : $msg = 'ایمیل صحیح نیست'; break;
            case '-61' : $msg = 'کد ملی صحیح نیست'; break;
            case '-62' : $msg = 'کد پستی صحیح نیست'; break;
            case '-63' : $msg = 'آدرس پستی صحیح نیست و یا بیش از ۱۵۰ کارکتر است'; break;
            case '-64' : $msg = 'توضیحات صحیح نیست و یا بیش از ۱۵۰ کارکتر است'; break;
            case '-65' : $msg = 'نام و نام خانوادگی صحیح نیست و یا بیش از ۳۵ کاکتر است'; break;
            case '-66' : $msg = 'تلفن صحیح نیست'; break;
            case '-67' : $msg = 'نام کاربری صحیح نیست یا بیش از ۳۰ کارکتر است'; break;
            case '-68' : $msg = 'نام محصول صحیح نیست و یا بیش از ۳۰ کارکتر است'; break;
            case '-69' : $msg = 'آدرس ارسالی برای بازگشت موفق صحیح نیست و یا بیش از ۱۰۰ کارکتر است'; break;
            case '-70' : $msg = 'آدرس ارسالی برای بازگشت ناموفق صحیح نیست و یا بیش از ۱۰۰ کارکتر است'; break;
            case '-71' : $msg = 'موبایل صحیح نیست'; break;
            case '-72' : $msg = 'بانک پاسخگو نبوده است لطفا با نکست پی تماس بگیرید'; break;
            case '-73' : $msg = 'مسیر بازگشت دارای خطا میباشد یا بسیار طولانیست'; break;
            case '-90' : $msg = 'بازگشت مبلغ بدرستی انجام شد'; break;
            case '-91' : $msg = 'عملیات ناموفق در بازگشت مبلغ'; break;
            case '-92' : $msg = 'در عملیات بازگشت مبلغ خطا رخ داده است'; break;
            case '-93' : $msg = 'موجودی صندوق کاربری برای بازگشت مبلغ کافی نیست'; break;
            case '-94' : $msg = 'کلید بازگشت مبلغ یافت نشد'; break;
            default:
                $msg = 'خطای ناشناخته درگاه نکست پی'; break;
                break;
        }
        return $msg;
    }
}
?>