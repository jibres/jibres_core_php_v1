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


    public static function listByDetail($_args = [])
    {
        $planDetail = [];

        $currentPlanDetail = new businessPlanDetail(\lib\store::id());
        $currentPlan       = $currentPlanDetail->currentPlan();
        $period            = 'yearly';

        if(isset($_args['period']) && in_array($_args['period'], ['monthly', 'yearly']))
        {
            $period = $_args['period'];
        }

        foreach (self::list() as $plan)
        {
            $myPlan = planLoader::load($plan);

            if(self::allowToShow($myPlan))
            {
                $planDetail[] = self::getPlanDetail($myPlan, $currentPlan, $period);
            }
        }

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


    private static function getPlanDetail(plan $_myPlan, $_currentPlan, $_period) : array
    {
        $planPrice          = new planPrice($_myPlan);
        $currency           = $planPrice->getCurrency();
        $currencyName       = \lib\currency::name($currency);

        $isActive = false;
        if(isset($_currentPlan['plan']) && $_currentPlan['plan'] === $_myPlan->name())
        {
            $isActive = true;
        }

        $planDetail =
        [
            'name'            => $_myPlan->name(),
            'title'           => $_myPlan->title(),
            'description'     => $_myPlan->description(),
            'featureList'     => $_myPlan->featureList(),
            'price'           => $planPrice->calculatePrice($_period),
            'currency'        => $currency,
            'currencyName'    => $currencyName,
            'isActive'        => $isActive,
        ];
        return $planDetail;
    }
}