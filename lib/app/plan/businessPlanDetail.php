<?php

namespace lib\app\plan;

class businessPlanDetail
{
    private static $currnentPlanDetail = null;


    public static function currnentPlan()
    {
        if(!\dash\engine\store::inStore())
        {
            return false;
        }

        self::loadDetailOnce();

    }


    private static function loadDetailOnce()
    {
        // load once!
        if(is_array(self::$currnentPlanDetail))
        {
            return;
        }

        $planDetailOnJibres = \lib\api\jibres\api::plan_detail(\lib\store::id());
        var_dump($planDetailOnJibres);
        exit;
    }
}