<?php

namespace lib\app\plan;

class storePlan
{

    public static function currentPlan($_business_id)
    {
        $loadBusinessData = \lib\db\store\get::data($_business_id);
        $dateNow = date("Y-m-d H:i:s");
        $planHistoryList = \lib\db\store_plan_history\get::activePlanList($_business_id, $dateNow);

        var_dump($planHistoryList);exit();
    }

}