<?php

namespace lib\app\sms;


class recend
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

}
