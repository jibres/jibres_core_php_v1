<?php

namespace lib\app\plan;

class planList
{
    public static function list() : array
    {
        return
        [
            'free',
            'gold',
            'diamond',
        ];
    }

    public static function listByDetail()
    {
        $planDetail = [];
        foreach (self::list() as $plan)
        {
            $class = sprintf('%s\%s', __NAMESPACE__, $plan);
            $myPlan = new $class;

            $planDetail[] =
                [
                    'name' => $myPlan->name(),
                    'title' => $myPlan->title(),
                    'price' => $myPlan->price(),
                ];
        }

        return $planDetail;
    }
}