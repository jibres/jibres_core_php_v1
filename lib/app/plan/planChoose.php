<?php

namespace lib\app\plan;

class planChoose
{


    public static function choose(string $_plan_name)
    {
        $plan = \dash\validate::string_50($_plan_name);

        if(!in_array($plan, planList::list()))
        {
            \dash\notif::error(T_("Invalid plan"));
            return false;
        }


        $class = sprintf('%s\%s', __NAMESPACE__, $plan);
        $myPlan = new $class;

        var_dump(get_class_methods($myPlan));
        var_dump($myPlan);exit;

        // $planDetail[] =
        //     [
        //         'name' => $myPlan->name(),
        //         'title' => $myPlan->title(),
        //         'price' => $myPlan->price(),
        //     ];


        return $planDetail;
    }
}