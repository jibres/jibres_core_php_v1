<?php

namespace lib\app\plan;

class storePlan
{

    public static function currentPlan($_business_id)
    {
        $loadBusinessData = \lib\db\store\get::data($_business_id);
        print_r($loadBusinessData);exit;
    }

}