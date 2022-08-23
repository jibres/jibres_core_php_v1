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
        $loadBusinessData      = \lib\db\store\get::data($_business_id);
        $lastPlanHistoryRecord = self::lastPlanHistoryRecord($_business_id);
        $currentPlan            = self::detectPlan($_business_id, $loadBusinessData, $lastPlanHistoryRecord);
        var_dump($currentPlan);;exit();
        return $planDetail;

    }

    private static function lastPlanHistoryRecord($_business_id)
    {
        $lastPlanHistoryRecord = \lib\db\store_plan_history\get::lastPlanHistoryRecord($_business_id);

        if(!$lastPlanHistoryRecord)
        {
            planSet::set($_business_id, 'free');
            $lastPlanHistoryRecord = \lib\db\store_plan_history\get::lastPlanHistoryRecord($_business_id);
        }
        return $lastPlanHistoryRecord;
    }

    private static function detectPlan($_business_id, $_loadBusinessData, $_lastPlanRecord) : array
    {
        $result = [];

        if(!$_lastPlanRecord)
        {
            // @BUG All business must have plan record
            return $result;
        }

        $currentPlan = null;

        if(isset($_lastPlanRecord['plan']) && $_lastPlanRecord['plan'])
        {
            $currentPlan = $_lastPlanRecord['plan'];
        }

        // TODO need check status and
        if(isset($_lastPlanRecord['status']) && $_lastPlanRecord['status'] === 'active')
        {
            // ok. Nothing.
        }

        if(!\dash\validate::is_equal($currentPlan, a($_loadBusinessData, 'plan')))
        {
            \lib\db\store\update::store_data('plan', $currentPlan, $_business_id);
        }


        if(!\dash\validate::is_equal(a($_lastPlanRecord, 'expirydate'), a($_loadBusinessData, 'planexp')))
        {
            \lib\db\store\update::store_data('planexp', $_lastPlanRecord['expirydate'], $_business_id);
        }

        return $currentPlan;


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