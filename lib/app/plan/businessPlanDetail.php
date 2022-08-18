<?php

namespace lib\app\plan;

class businessPlanDetail
{
    private $store_id           = null;

    private $currnentPlanDetail = null;


    public function __construct($_business_id)
    {
        $this->store_id = $_business_id;

        $this->loadDetailOnce();
    }


    private function loadDetailOnce()
    {
        // load once!
        if(is_array($this->currnentPlanDetail))
        {
            return;
        }

        $planDetailOnJibres = \lib\api\jibres\api::plan_detail($this->store_id);

        var_dump($planDetailOnJibres);
        exit;
    }
}