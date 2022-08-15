<?php
namespace content_r10\jibres\plan;


class view
{
	public static function config()
	{
		$business_id = \content_r10\tools::get_current_business_id();

		$result = \lib\app\plan\planActiveate::currentPlanDetail($business_id);

		\content_r10\tools::say($result);
	}
}
?>