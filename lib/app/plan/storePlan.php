<?php

namespace lib\app\plan;

use lib\app\plan\plans\nullObjectPlan;

class storePlan
{

    public static function currentPlan($_business_id)
    {
        $dateNow = date("Y-m-d H:i:s");

        $loadBusinessData = \lib\db\store\get::data($_business_id);
        $planHistoryList = \lib\db\store_plan_history\get::activePlanList($_business_id, $dateNow);

        $plan = self::detectPlan($_business_id, $loadBusinessData, $planHistoryList);

        $resutl = self::readyPlan($plan);

        return $resutl;
    }

    private static function detectPlan($_business_id, $_loadBusinessData, $_planHistoryList) : plan
    {
        $result = null;

        if(!$_planHistoryList)
        {
            // no active plan
            $result = new nullObjectPlan();
        }

        return $result;

    }

    private static function readyPlan(plan $_plan) : array
    {
        $result = [];
        $result['name'] = $_plan->name();
        $result['title'] = $_plan->title();
        $result['planexp'] = null;
        return $result;
    }


}