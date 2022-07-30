<?php

namespace lib\app\sms;


class edit
{
    public static function edit($_args, $_id)
    {

        $id = \dash\validate::id($_id);
        if(!$id)
        {
            return false;
        }

        $args = check::variable($_args);

        if(!$args || !\dash\engine\process::status())
        {
            return false;
        }

        $data = \dash\cleanse::patch_mode($_args, $args);

        if($data)
        {
            \lib\db\sms_log\update::record($data, $id);
            \dash\notif::ok(T_("Update successfull"));
            return true;
        }
        else
        {
            \dash\notif::error(T_("Can not update data!"));
            return true;
        }

    }
}
