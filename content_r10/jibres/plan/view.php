<?php
namespace content_r10\jibres\plan;


class view
{
	public static function config()
	{
		$business_id = \content_r10\tools::get_current_business_id();
		if(\dash\request::get('gethistory'))
		{
			$result = \lib\app\plan\storePlan::activePlanHistory($business_id);
		}
		elseif(\dash\request::get('factor'))
		{
			$result = \lib\app\plan\planFactor::calculate($business_id, \dash\request::get());
		}
        else
        {
            $result = \lib\app\plan\storePlan::currentPlan($business_id);
        }

		\content_r10\tools::say($result);
	}
}
?>