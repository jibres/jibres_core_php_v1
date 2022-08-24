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


    public static function currentPlan($_business_id) : array
    {
        $loadBusinessData      = \lib\db\store\get::data($_business_id);
        $lastPlanHistoryRecord = self::lastPlanHistoryRecord($_business_id);
        $currentPlan           = self::checkPlanRecord($_business_id, $loadBusinessData, $lastPlanHistoryRecord);

        if($currentPlan)
        {
            $planDetail = $lastPlanHistoryRecord;
        }
        else
        {
            $planDetail = [];
        }
        return $planDetail;
    }

    private static function lastPlanHistoryRecord($_business_id)
    {
        $lastPlanHistoryRecord = \lib\db\store_plan_history\get::lastPlanHistoryRecord($_business_id);

        if(!$lastPlanHistoryRecord)
        {
            planSet::setFirstPlan($_business_id, 'free');
            $lastPlanHistoryRecord = \lib\db\store_plan_history\get::lastPlanHistoryRecord($_business_id);
        }
        return $lastPlanHistoryRecord;
    }

    private static function checkPlanRecord($_business_id, $_loadBusinessData, $_lastPlanRecord)
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
        $args = self::cleanArgsAfterPay($_args);

        $store_id       = a($args, 'store_id');
        $plan           = a($args, 'plan');
        $period         = a($args, 'period');


        if(!$plan)
        {
            \dash\notif::error(T_("Plan not found"));
            return false;
        }

        $currentPlan = self::currentPlan($store_id, true);

        $newPlan = planLoader::load($plan);
        $newPlan->setPeriod($period);
        $newPlan->prepare();


        if(planChoose::allowChoosePlan($currentPlan, $newPlan))
        {
            $title = T_("Activate plan :plan", ['plan' => $newPlan->title()]);

            planSet::set($store_id, $newPlan, $currentPlan);
            self::minusTransaction($args);
            return true;
        }
        else
        {
            \dash\notif::error(T_("Can not choose this plan"));
            return false;
        }
    }

    private static function cleanArgsAfterPay(array $_args)
    {
        $condition =
            [
                'plan'           => ['enum' => planList::list()],
                'period'         => ['enum' => ['monthly', 'yearly']],
                'transaction_id' => 'id',
                'store_id'       => 'id',
                'planName'       => 'string',
                'user_id'        => 'id',
                'price'          => 'id',
            ];

        $require = ['plan'];

        $meta    = [];

        $data = \dash\cleanse::input($_args, $condition, $require, $meta);

        return $data;
    }

    private static function minusTransaction(array $_args)
    {
        $insert_transaction =
            [
                'user_id' => $_args['user_id'],
                'title'   => T_("Activate plan :plan", ['plan' => $_args['planName']]),
                'amount'  => floatval($_args['price']),

            ];

        \dash\app\transaction\budget::plus($insert_transaction);

    }


}