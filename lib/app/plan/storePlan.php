<?php

namespace lib\app\plan;



use lib\app\plan\plans\free;

class storePlan
{

    public static function activate($_business_id, array $_args)
    {
        $data = self::cleanArgs($_args);

        $plan   = $data['plan'];
        $myPlan = planLoader::load($plan);

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


    public static function currentPlan($_business_id)
    {
        $loadBusinessData = \lib\db\store\get::data($_business_id);
        $planHistoryList  = self::planHistoryList($_business_id);
        $planDetail       = self::detectPlan($_business_id, $loadBusinessData, $planHistoryList);

        return $planDetail;

    }

    private static function planHistoryList($_business_id)
    {
        $dateNow = date("Y-m-d H:i:s");
        $planHistoryList = \lib\db\store_plan_history\get::activePlanList($_business_id, $dateNow);

        if(!$planHistoryList)
        {
            planSet::set($_business_id, 'free');
            $planHistoryList = \lib\db\store_plan_history\get::activePlanList($_business_id, $dateNow);
        }
        return $planHistoryList;
    }

    private static function detectPlan($_business_id, $_loadBusinessData, $_planHistoryList) : array
    {
        $result = [];

        if(!$_planHistoryList)
        {
            // @BUG All business must have plan record
            return $result;
        }

        


        return $result;

    }

    public static function afterPay($_args = [])
    {
        $args = $_args;
        if(!$args)
        {
            $args =
                [
                    'store_id'       => 1001483,
                    'plan'           => 'diamond',
                    'period'         => 'monthly',
                    'transaction_id' => 6519,
                ];
        }

        $store_id       = a($args, 'store_id');
        $plan           = a($args, 'plan');
        $period         = a($args, 'period');
        $transaction_id = a($args, 'transaction_id');

        $currentPlan = self::currentPlan($store_id);
//        return;
        var_dump($currentPlan);;




        var_dump($args);exit();

    }


}