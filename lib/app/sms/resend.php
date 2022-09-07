<?php

namespace lib\app\sms;


class resend
{
    public static function one($_id)
    {

        $id = \dash\validate::id($_id);
        if(!$id)
        {
            return false;
        }

        $load = \lib\app\sms\get::get($id);

        if(a($load, 'status') === 'moneylow')
        {
            // ok
            // check sms plugin pack

            if(\lib\app\plugin\business::is_activated('sms_pack'))
            {
                $post               = [];
                $post['mobile']     = a($load, 'mobile');
                $post['message']    = a($load, 'message');
                $post['sender']     = 'admin';
                $post['resendfrom'] = a($load, 'id');

                $result = \lib\app\sms\queue::add_one($post);

                if(isset($result['id']))
                {
                    $meta = [];

                    if(is_string($load['meta']))
                    {
                        $meta = json_decode($load['meta'], true);

                        if(!is_array($meta))
                        {
                            $meta = [];
                        }
                    }

                    $meta['resend-id'] = $result['id'];

                    $meta = json_encode($meta);

                    \lib\db\sms_log\update::record(['status' => 'resend', 'meta' => $meta], $id);

                    \dash\notif::ok(T_("Your sms was resended"));
                    return true;
                }
                else
                {
                    \dash\notif::error(T_("Can not resend your sms"));
                    return false;
                }

            }
            else
            {
                \dash\notif::error(T_("You must have active sms pack plugin to resend sms"));
                return false;
            }
        }
        else
        {
            \dash\notif::error(T_("Only SMS messages that have not been sent due to insufficient charge can be re-sent"));
            return false;
        }


    }


    public static function archive_all()
    {
        \lib\db\sms_log\update::archive_all_not_sended_query();

        \dash\notif::ok(T_("All Not sent sms was archived"));

        return true;
    }


    /**
     * Resend all sms
     */
    public static function all()
    {
        $moneylow_list = \lib\db\sms_log\get::moneylow_list();

        if(!is_array($moneylow_list))
        {
            $moneylow_list = [];
        }

        $sending_queue =
        [
            'telegram' => [],
            'sms'      => [],
            'email'    => [],
        ];

        foreach ($moneylow_list as $key => $value)
        {
            if(isset($value['mobile']) && isset($value['message']))
            {
                $resendArgs =
                [
                    'mobile'     => $value['mobile'],
                    'message'    => $value['message'],
                    'resendfrom' => $value['id'],
                ];

                $result = \lib\app\sms\queue::add_one($resendArgs, ['return_args' => true]);


                if(isset($result['id']))
                {
                    $meta = [];

                    if(is_string($value['meta']))
                    {
                        $meta = json_decode($value['meta'], true);

                        if(!is_array($meta))
                        {
                            $meta = [];
                        }
                    }

                    $meta['resend-id'] = $result['id'];

                    $meta = json_encode($meta);

                    \lib\db\sms_log\update::record(['status' => 'resend', 'meta' => $meta], $value['id']);

                }

                $sending_queue['sms'][$key]['sms_param'] = $result;

            }
        }

        if(!empty($sending_queue['sms']))
        {
            $finalResult = \lib\api\jibres\api::send_multiple_notif($sending_queue);

            \dash\log::save_multiple_notif_result($finalResult);
        }

        \dash\notif::ok(T_(":val SMS was resended", ['val' => \dash\fit::number(count($sending_queue['sms']))]));
        return true;
    }
}
