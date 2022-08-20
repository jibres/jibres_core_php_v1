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
            'rafiei'
        ];
    }


    public static function listByDetail()
    {
        $planDetail = [];

        $currnentPlanDetail = new businessPlanDetail(\lib\store::id());
        $currnentPlan = $currnentPlanDetail->currentPlan();

        foreach (self::list() as $plan)
        {
            $myPlan = planLoader::load($plan);

            if(self::allowToShow($myPlan))
            {
                $planDetail[] = self::getPlanDetail($myPlan, $currnentPlan);
            }
        }

        storePlan::afterPay();

        return $planDetail;
    }

    private static function allowToShow(plan $myPlan)
    {
        if($myPlan->type() === 'public')
        {
            return true;
        }

        if($myPlan->type() === 'enterprise')
        {
            if(\lib\store::enterprise() === $myPlan->enterprise())
            {
                return true;
            }
        }
        return false;
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