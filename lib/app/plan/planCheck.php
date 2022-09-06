<?php

namespace lib\app\plan;

class planCheck
{

    public static function access($_plugin_key) : bool
    {
        $loadCurrentPlan = businessPlanDetail::getMyPlanDetail();
        if($loadCurrentPlan)
        {
            $contain = $loadCurrentPlan->contain();
        }

        if(in_array($_plugin_key, $contain))
        {
            return true;
        }
        else
        {
            return false;
        }

    }


}