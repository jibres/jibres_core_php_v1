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

        $currnentPlanDetail = new businessPlanDetail(\lib\store::id());
        $currnentPlan = $currnentPlanDetail->currentPlan();

        foreach (self::list() as $plan)
        {
            $class        = sprintf('%s\%s\%s', __NAMESPACE__, 'plans', $plan);
            $myPlan       = new $class;
            $planDetail[] = self::getPlanDetail($myPlan, $currnentPlan);
        }

        return $planDetail;
    }


    private static function getPlanDetail(plan $_myPlan, $_currentPlan) : array
    {
        $planPrice          = new planPrice($_myPlan);
        $currency           = $planPrice->getCurrency();
        $currencyName       = \lib\currency::name($currency);

        $isActive = false;
        if(isset($_currentPlan['name']) && $_currentPlan['name'] === $_myPlan->name())
        {
            $isActive = true;
        }

        $planDetail =
        [
            'name'            => $_myPlan->name(),
            'title'           => $_myPlan->title(),
            'featureList'     => $_myPlan->featureList(),
            'price'           => $planPrice->calculatePrice(1),
            'currency'        => $currency,
            'currencyName'    => $currencyName,
            'isActive'        => $isActive,
        ];
        return $planDetail;
    }
}