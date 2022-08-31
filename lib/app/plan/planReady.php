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


	public static function calculateDays(&$currnentPlanRecordDetail)
	{
		if(isset($currnentPlanRecordDetail['expirydate']) &&$currnentPlanRecordDetail['expirydate'])
		{
			if(strtotime($currnentPlanRecordDetail['expirydate']) > time())
			{
				$date1 = new \DateTime(date("Y-m-d H:i:s"));  //current date or any date
				$date2 = new \DateTime($currnentPlanRecordDetail['expirydate']);   //Future date
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

			if(isset($currnentPlanRecordDetail['days']) && $currnentPlanRecordDetail['days'] && $days)
			{
				$daysRemainPercent = \dash\number::percent($days, $currnentPlanRecordDetail['days']);
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

			$currnentPlanRecordDetail['daysLeft'] = $days;
			$currnentPlanRecordDetail['daysRemainPercent'] = $daysRemainPercent;

		}

		if(isset($currnentPlanRecordDetail['startdate']) && $currnentPlanRecordDetail['startdate'])
		{
			$date1                                 = new \DateTime(date("Y-m-d H:i:s"));  //current date or any date
			$date2                                 = new \DateTime($currnentPlanRecordDetail['startdate']);   //Future date
			$diff                                  = $date2->diff($date1)->format("%a");  //find difference
			$days                                  = intval($diff);   //rounding days 1 is today
			$currnentPlanRecordDetail['daysSpent'] = $days;

		}
	}

}