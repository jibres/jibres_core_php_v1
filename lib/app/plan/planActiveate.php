<?php

namespace lib\app\plan;

class planActiveate
{

    public static function activate($_business_id, array $_args)
    {
        $data = self::cleanArgs($_args);

        $plan   = $data['plan'];
        $class  = sprintf('%s\%s\%s', __NAMESPACE__, 'plans', $plan);
        $myPlan = new $class;

        $planPrice = new planPrice($myPlan);
        $readyPlan = new planPay($myPlan, $planPrice);
        $readyPlan->setStoreId($_business_id);

        $readyPlan->readyToPay($data);

        $result =
        [
            'needPay'      => $readyPlan->needPay(),
            'payLink'      => $readyPlan->payLink(),
        ];

        return $result;
    }


    private static function cleanArgs(array $_args)
    {
        $condition =
        [
            'plan'       => ['enum' => planList::list()],
            'period'     => ['enum' => ['monthly', 'yearly']],
            'use_budget' => 'bit',
            'turn_back'  => 'string_2000',
        ];

        $require = ['plan'];

        $meta    = [];

        $data = \dash\cleanse::input($_args, $condition, $require, $meta);

        return $data;
    }
}