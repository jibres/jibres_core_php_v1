<?php

namespace lib\app\sms;

class delivery
{
    public static function save_delivery($_service ,$_messageid, $_status)
    {
        $status = self::detect_status($_service, $_status);

        if(!$status)
        {
            return false;
        }
        // load sms by provider sms id (messageid)
        $sms_detail = \lib\db\sms\get::by_messageid($_messageid);

        if(!isset($sms_detail['id']))
        {
            return false;
        }

        if($sms_detail['status'] === $status)
        {
            // nothing
            return false;
        }

        $update =
        [
            'provider_status' => $_status,
            'status' => $status,
            'datemodified' => date("Y-m-d H:i:s"),
        ];

        if($status === 'delivered')
        {
            $update['datedeliver'] = date("Y-m-d H:i:s");
        }

        \lib\db\sms\update::record($update, $sms_detail['id']);

        if(isset($sms_detail['store_id']))
        {
            // send status by api in business
            $send =
            [
                'store_smslog_id' => $sms_detail['store_smslog_id'],
                'status' => $status,
            ];
            \lib\api\business\api::set_sms_delivery($sms_detail['store_id'], $send);
        }



    }


    public static function business_set_delivery($_sms_log_id, $_status)
    {
        if($id = \dash\validate::id($_sms_log_id))
        {
            $load = \lib\app\sms\get::get($id);
            if(isset($load['id']))
            {
                $update =
                [
                    'status' => $_status,
                ];

                \lib\db\sms_log\update::record($update, $load['id']);
            }
        }

    }


    private static function detect_status($_service, $_status)
    {
        $status = null;
        // database enum of sms status
        //enum(status): 'register','pending','sending','expired','moneylow','unknown','send','sended','delivered','queue','failed','undelivered','cancel','block','other'
        // enum(deliverystatus): 'delivered','undelivered','block','other','failed','cancel'

        switch ($_service)
        {
            case 'kavenegar':
                switch ($_status)
                {
                    case 1: case '1': $status = 'queue';  break; //در صف ارسال قرار دارد
                    case 2: case '2': $status = 'other';  break; //زمان بندی شده (ارسال در تاریخ معین)
                    case 4: case '4': $status = 'send';  break; //ارسال شده به مخابرات
                    case 5: case '5': $status = 'send';  break; //ارسال شده به مخابرات (همانند وضعیت 4)
                    case 6: case '6': $status = 'failed';  break; //خطا در ارسال پیام که توسط سر شماره پیش می آید و به معنی عدم رسیدن پیامک می‌باشد (Failed)
                    case 10: case '10': $status = 'delivered';  break; //رسیده به گیرنده (Delivered)
                    case 11: case '11': $status = 'undelivered';  break; //نرسیده به گیرنده ، این وضعیت به دلایلی از جمله خاموش یا خارج از دسترس بودن گیرنده اتفاق می افتد (Undelivered)
                    case 13: case '13': $status = 'cancel';  break; //ارسال پیام از سمت کاربر لغو شده یا در ارسال آن مشکلی پیش آمده که هزینه آن به حساب برگشت داده می‌شود
                    case 14: case '14': $status = 'block';  break; //بلاک شده است، عدم تمایل گیرنده به دریافت پیامک از خطوط تبلیغاتی که هزینه آن به حساب برگشت داده می‌شود
                    case 100: case '100': $status = 'unknown';  break; //شناسه پیامک نامعتبر است ( به این معنی که شناسه پیام در پایگاه داده کاوه نگار ثبت نشده است یا متعلق به شما نمی‌باش
                }
                break;

            default:
                $status = null;
                break;
        }

        return $status;
    }
}