<?php

namespace lib\app\plan;

class businessPlanDetail
{
    private $currnentPlanDetail = null;

    public static function getMyPlanDetail()
    {
        if(!\lib\store::id())
        {
            return false;
        }

        $currentPlanDetail = new businessPlanDetail(\lib\store::id());
        $currentPlanDetail->prepare();
        return $currentPlanDetail->currentPlan();
    }


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
            // TODO check sync required
            // TODO check local account and if need send api request to get last detail
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

    public function prepare()
    {
        if($this->currnentPlanDetail)
        {
            if(isset($this->currnentPlanDetail['expirydate']) &&$this->currnentPlanDetail['expirydate'])
            {
                $date1 = new \DateTime(date("Y-m-d H:i:s"));  //current date or any date
                $date2 = new \DateTime($this->currnentPlanDetail['expirydate']);   //Future date
                $diff = $date2->diff($date1)->format("%a");  //find difference
                $days = intval($diff);   //rounding days

                if($days < 0)
                {
                    $days = null;
                }

                $this->currnentPlanDetail['daysLeft'] = $days;

            }
        }
    }

    public function currentPlan()
    {
        return $this->currnentPlanDetail;
    }
}