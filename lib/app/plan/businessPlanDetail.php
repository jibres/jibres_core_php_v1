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



    public static function getMyCurrentPlanDetail()
    {
        $currentPlanDetail = self::getMyPlanDetail();
        if($currentPlanDetail)
        {
            return planReady::ready($currentPlanDetail->currentPlan());
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
        $planSettingRecord = \lib\db\setting\get::by_cat_key('plan', 'last');

        if(!is_array($planSettingRecord))
        {
            $planSettingRecord = [];
        }

        if(isset($planSettingRecord['value']))
        {
            $planSettingRecord = json_decode($planSettingRecord['value'], true);
            if(!is_array($planSettingRecord))
            {
                $planSettingRecord = [];
            }
        }
        else
        {
            $planSettingRecord = [];
        }


        return $planSettingRecord;
    }

    private function syncRequired()
    {
        $planSyncSetting = \lib\db\setting\get::by_cat_key('plan', 'synced');

        if(isset($planSyncSetting['value']))
        {
            if($planSyncSetting['value'] === 'no')
            {
                $syncRequired = true;
            }
            elseif($syncTime = strtotime($planSyncSetting['value']))
            {
                if($syncTime < (time() - (60*30)) || 1)
                {
                    $syncRequired = true;
                }
                else
                {
                    $syncRequired = false;
                }
            }
            else
            {
                $syncRequired = true;
            }
        }
        else
        {
            $syncRequired = true;
        }

        return $syncRequired;

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

        $this->setSynced();

        $this->savePlanInSetting($result);



        return $result;

    }

    private function setSynced()
    {
        \lib\db\setting\update::overwirte_cat_key(date("Y-m-d H:i:s"), 'plan', 'synced');
    }

    private function savePlanInSetting($_planDetail)
    {
        \lib\db\setting\update::overwirte_cat_key(json_encode($_planDetail), 'plan', 'last');

    }
}