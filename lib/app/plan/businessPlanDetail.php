<?php

namespace lib\app\plan;

class businessPlanDetail
{
    private $currnentPlanDetail = null;


    public function __construct($_business_id)
    {
        $this->store_id = $_business_id;

        $this->loadDetailOnce();

    }

    public function name()
    {
        if(isset($this->currnentPlanDetail['plan']))
        {
            return $this->currnentPlanDetail['plan'];
        }
        return null;
    }



    private function loadDetailOnce()
    {
        // load once!
        if(!is_array($this->currnentPlanDetail))
        {
            $planDetailOnJibres = \lib\api\jibres\api::plan_detail();

            if(isset($planDetailOnJibres['result']))
            {
                $this->currnentPlanDetail = $planDetailOnJibres['result'];
            }
            else
            {
                $this->currnentPlanDetail = [];
            }
        }

        return $this->currnentPlanDetail;

    }

    public function currentPlan()
    {
        return $this->currnentPlanDetail;
    }
}