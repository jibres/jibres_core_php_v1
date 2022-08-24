<?php

namespace lib\app\plan;

class planSet
{

    public static function setFirstPlan($_business_id, string $_plan, $_period = null)
    {
        $expirydate = null;

        $myPlan = planLoader::load($_plan);
        $myPlan->prepare();

        if($_period)
        {
            $myPlan->setPeriod($_period);
        }


        $insert =
            [
                'store_id'         => $_business_id,
                'user_id'          => \dash\user::id(),
                'plan'             => $_plan,
                'startdate'        => date("Y-m-d H:i:s"),
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

        $save = \lib\db\store_plan_history\insert::new_record($insert);

    }


}