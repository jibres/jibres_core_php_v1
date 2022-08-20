<?php

namespace lib\app\plan;

use lib\app\plan\plans\nullObjectPlan;

class businessPlanDetail
{
    private $currnentPlanDetail;


    public function __construct($_business_id)
    {
        $this->store_id = $_business_id;

        $this->loadDetailOnce();

        return $this->currnentPlanDetail;
    }


    private function loadDetailOnce()
    {
        // load once!
        if(!is_a($this->currnentPlanDetail, 'plan'))
        {
            $planDetailOnJibres = \lib\api\jibres\api::plan_detail();

            if(isset($planDetailOnJibres['result']))
            {
                $this->currnentPlanDetail = $planDetailOnJibres['result'];
            }
            else
            {
                $this->currnentPlanDetail = new nullObjectPlan();
            }
        }

        return $this->currnentPlanDetail;

    }
}