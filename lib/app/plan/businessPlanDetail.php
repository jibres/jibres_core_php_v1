<?php

namespace lib\app\plan;

class businessPlanDetail
{
    private $currnentPlanRecordDetail = null;
    private $currentPlan;

    public static function getMyPlanDetail()
    {
        if(!\lib\store::id())
        {
            return false;
        }

        $currentPlanDetail = new businessPlanDetail(\lib\store::id());
        $currentPlanDetail->prepare();

        return $currentPlanDetail;

    }



    public static function getMyPlanHistoryDetail()
    {
        $currentPlanDetail = self::getMyPlanDetail();
        if($currentPlanDetail)
        {
            return $currentPlanDetail->currentPlan();
        }
        return false;
    }

    public function __construct($_business_id)
    {
        $this->store_id = $_business_id;

        $this->loadDetailOnce();

    }

    public function name()
    {
        if(isset($this->currnentPlanRecordDetail['plan']))
        {
            return $this->currnentPlanRecordDetail['plan'];
        }
        return null;
    }

    private function loadDetailOnce()
    {
        // load once!
        if(!is_array($this->currnentPlanRecordDetail))
        {
            // TODO check sync required
            // TODO check local account and if need send api request to get last detail
            $planDetailOnJibres = \lib\api\jibres\api::plan_detail();

            if(isset($planDetailOnJibres['result']))
            {
                $this->currnentPlanRecordDetail = $planDetailOnJibres['result'];
            }
            else
            {
                $this->currnentPlanRecordDetail = [];
            }
        }

        return $this->currnentPlanRecordDetail;

    }

    public function prepare()
    {
        if($this->currnentPlanRecordDetail)
        {
            if(isset($this->currnentPlanRecordDetail['expirydate']) &&$this->currnentPlanRecordDetail['expirydate'])
            {
                $date1 = new \DateTime(date("Y-m-d H:i:s"));  //current date or any date
                $date2 = new \DateTime($this->currnentPlanRecordDetail['expirydate']);   //Future date
                $diff = $date2->diff($date1)->format("%a");  //find difference
                $days = intval($diff);   //rounding days

                if($days < 0)
                {
                    $days = null;
                }

                $this->currnentPlanRecordDetail['daysLeft'] = $days;

            }
        }

        // TODO check expire date and disable if expired

        if($this->name())
        {
            $this->currentPlan = planLoader::load($this->name());
        }
    }

    public function currentPlan()
    {
        return $this->currnentPlanRecordDetail;
    }


    public function contain() : array
    {
        if($this->currentPlan)
        {
            return $this->currentPlan->contain();
        }
        return [];
    }
}