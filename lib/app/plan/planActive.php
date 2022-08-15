<?php

namespace lib\app\plan;

class planActive
{


    public static function activate($_business_id, array $_args)
    {
        $data = self::cleanArgs($_args);

        $plan   = $data['plan'];
        $class  = sprintf('%s\%s', __NAMESPACE__, $plan);
        $myPlan = new $class;

        $readyPlan = new \lib\app\plan\planPay($myPlan);
        $readyPlan->readyToPay($data);

        $result =
        [
            'needPay' => $readyPlan->needPay(),
            'payLink' => $readyPlan->payLink(),
        ];


        return $result;
    }


    private static function cleanArgs(array $_args)
    {
        $condition =
        [
            'plan'       => ['enum' => planList::list()],
            'period'     => ['enum' => ['1', '12']],
            'use_budget' => 'bit',
            'turn_back'  => 'string_2000',
        ];

        $require = ['plan'];

        $meta    = [];

        $data = \dash\cleanse::input($_args, $condition, $require, $meta);

        return $data;
    }
}