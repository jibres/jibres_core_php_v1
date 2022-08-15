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
            $class        = sprintf('%s\%s', __NAMESPACE__, $plan);
            $myPlan       = new $class;
            $planDetail[] = self::getPlanDetail($myPlan);
        }


        return $planDetail;
    }


    private static function getPlanDetail($_myPlan) : array
    {
        $currency     = $_myPlan->getCurrency();
        $currencyName = \lib\currency::name($currency);

        $planDetail =
        [
            'name'         => $_myPlan->name(),
            'title'        => $_myPlan->title(),
            'price'        => $_myPlan->calculatePrice(1),
            'featureList'  => $_myPlan->featureList(),
            'currency'     => $currency,
            'currencyName' => $currencyName,
        ];

        return $planDetail;
    }
}