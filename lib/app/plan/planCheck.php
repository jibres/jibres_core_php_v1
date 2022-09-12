<?php

namespace lib\app\plan;

class planCheck
{

    public static function access($_feature_key, $_place = null) : bool
    {
        $loadCurrentPlan = businessPlanDetail::getMyPlanDetail();

        if($loadCurrentPlan)
        {
            $contain = $loadCurrentPlan->contain();

			if(isset($contain[$_feature_key]))
			{
				return self::checkAccess($_feature_key, $contain[$_feature_key], $_place);
			}
			else
			{
				return false;
			}
        }
		else
		{
			return false;
		}

    }


	private static function checkAccess($_feature_key, mixed $_args, $_place) : bool
	{
		$loadFeature = \lib\app\plan\feature\generate::loadFeature($_feature_key, $_args);

		return $loadFeature->access($_place);
	}


}