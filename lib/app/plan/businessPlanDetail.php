<?php

namespace lib\app\plan;

class businessPlanDetail
{
    private $currnentPlanRecordDetail = null;
    private $currentPlan;
    private $settingRecord;

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
            $this->currnentPlanRecordDetail = $this->settingRecord();

            if($this->syncRequired())
            {
                $this->currnentPlanRecordDetail = $this->syncPlanSetting();
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


    private function settingRecord()
    {
        $planSettingRecord = \lib\db\setting\get::by_cat('plan');

        if(!is_array($planSettingRecord))
        {
            $planSettingRecord = [];
        }

        $this->settingRecord = $planSettingRecord;
        return $planSettingRecord;
    }

    private function syncRequired()
    {
        if($this->settingRecord)
        {
            return false;
        }

        return true;
    }

    private function syncPlanSetting()
    {
        $planDetailOnJibres = \lib\api\jibres\api::plan_detail();

        if(isset($planDetailOnJibres['result']))
        {
            $result = $planDetailOnJibres['result'];
        }
        else
        {
            $result = [];
        }

        // save synced time
        // save plan detail

        return $result;

    }
}