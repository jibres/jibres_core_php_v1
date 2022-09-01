<?php

namespace lib\app\plan;

class planReady
{

    public static function ready($_data)
    {
        $result = [];
        foreach ($_data as $key => $value)
        {
            switch ($key)
            {
                case 'plan':
                    $result[$key] = $value;
                    if($value)
                    {
                        $loadPlan = planLoader::load($value);
                        $result['planTitle'] = $loadPlan->title();
                        $result['planDescription'] = $loadPlan->description();
                        $result['planoutstandingFeatures'] = $loadPlan->outstandingFeatures();
                    }
                    break;

                default:
                    $result[$key] = $value;
                    break;
            }
        }

        return $result;
    }


	public static function calculateDays(&$currentPlanRecordDetail)
	{
		self::detectUserCanCancel($currentPlanRecordDetail);

		if(isset($currentPlanRecordDetail['expirydate']) &&$currentPlanRecordDetail['expirydate'])
		{
			self::detectDays($currentPlanRecordDetail);

			if($currentPlanRecordDetail['daysLeft'] <= 14)
			{
				$currentPlanRecordDetail['canRenew'] = true;
			}
			else
			{
				$currentPlanRecordDetail['canRenew'] = false;
			}

		}

		self::detectDaysSpent($currentPlanRecordDetail);

	}


	private static function detectUserCanCancel(&$currentPlanRecordDetail)
	{
		$currentPlanRecordDetail['canCancel'] = false;
		if(\dash\engine\store::inStore())
		{
			$owner   = \lib\store::owner();
			$user_id = \dash\user::jibres_user();
		}
		else
		{
			$owner   = \lib\db\store\get::owner($currentPlanRecordDetail['store_id']);
			$user_id = \dash\user::id();
		}

		if(\dash\validate::is_equal($owner, $user_id))
		{
			$currentPlanRecordDetail['canCancel'] = true;
		}
	}


	private static function detectDays(&$currentPlanRecordDetail)
	{
		if(strtotime($currentPlanRecordDetail['expirydate']) > time())
		{
			$date1 = new \DateTime(date("Y-m-d H:i:s"));  //current date or any date
			$date2 = new \DateTime($currentPlanRecordDetail['expirydate']);   //Future date
			$diff = $date2->diff($date1)->format("%a");  //find difference
			$days = intval($diff) + 1;   //rounding days 1 is today
		}
		else
		{
			$days = 0;
		}

		if($days < 0)
		{
			$days = null;
		}

		$daysRemainPercent = 0;

		if(isset($currentPlanRecordDetail['days']) && $currentPlanRecordDetail['days'] && $days)
		{
			$daysRemainPercent = \dash\number::percent($days, $currentPlanRecordDetail['days']);
			$daysRemainPercent = round($daysRemainPercent);
			if($daysRemainPercent > 100)
			{
				$daysRemainPercent = 100;
			}
			if($daysRemainPercent < 0)
			{
				$daysRemainPercent = 0;
			}

		}

		$currentPlanRecordDetail['daysLeft'] = $days;
		$currentPlanRecordDetail['daysRemainPercent'] = $daysRemainPercent;
	}


	private static function detectDaysSpent(&$currentPlanRecordDetail)
	{
		if(isset($currentPlanRecordDetail['startdate']) && $currentPlanRecordDetail['startdate'])
		{
			$date1                                 = new \DateTime(date("Y-m-d H:i:s"));  //current date or any date
			$date2                                 = new \DateTime($currentPlanRecordDetail['startdate']);   //Future date
			$diff                                  = $date2->diff($date1)->format("%a");  //find difference
			$days                                  = intval($diff);   //rounding days 1 is today
			$currentPlanRecordDetail['daysSpent'] = $days;

		}
	}

}