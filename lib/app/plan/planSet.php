<?php

namespace lib\app\plan;

class planSet
{

    public static function setFirstPlan($_business_id, string $_plan, $_period = null)
    {
        $myPlan = planLoader::load($_plan);
        $myPlan->prepare();

        if($_period)
        {
            $myPlan->setPeriod($_period);
        }

        self::set($_business_id, $myPlan);
    }

    public static function set($_business_id, plan $_newPlan, $_currentPlan = null)
    {
        $myPlan      = $_newPlan;
        $currentPlan = $_currentPlan;
        $startdate = date("Y-m-d H:i:s");
        if(isset($currentPlan['expirydate']) && $currentPlan['expirydate'])
        {
            $startdate = date("Y-m-d H:i:s", strtotime($currentPlan['expirydate']) + 1);
        }

        $expirydate = null;
        if($days = $myPlan->calculateDays())
        {
            $expirydate = date("Y-m-d H:i:s", strtotime($startdate) + ($days * 60 * 60 * 24));
        }


        $insert =
            [
                'store_id'         => $_business_id,
                'user_id'          => \dash\user::id(),
                'plan'             => $myPlan->name(),
                'startdate'        => $startdate,
                'expirydate'       => $expirydate,
                'type'             => $myPlan->type(),
                'action'           => 'set',
                'status'           => 'active',
                'reason'           => null,
                'periodtype'       => $myPlan->period(),
                'setby'            => $myPlan->setBy(),
                'days'             => $myPlan->calculateDays(),
                'price'            => $myPlan->price(),
                'discount'         => null,
                'vat'              => null,
                'finalprice'       => $myPlan->price(),
                'currency'         => $myPlan->currency(),
                'giftusage_id'     => null,
                'previous_plan_id' => null,
                'datecreated'      => date("Y-m-d H:i:s"),
                'datemodified'     => null,
            ];

        $planHistoryId = \lib\db\store_plan_history\insert::new_record($insert);
        return $planHistoryId;

    }


}