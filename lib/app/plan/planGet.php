<?php

namespace lib\app\plan;

class planGet
{

    public static function get($_id)
    {
        $id = \dash\validate::id($_id);
        $load = \lib\db\store_plan_history\get::by_id($id);

        if(!$load)
        {
            return [];
        }

        return $load;

    }


}