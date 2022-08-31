<?php
namespace content_a\plan\cancel;


class controller
{
	public static function routing()
	{

		$planDetail = \lib\app\plan\businessPlanDetail::getMyCurrentPlanDetail();

		if(!isset($planDetail['plan']))
		{
			\dash\header::status(404, T_("Plan Not found"));
		}

		if(!in_array($planDetail['plan'], \lib\app\plan\planList::cancelAble()))
		{
			\dash\header::status(404, T_("Can not cancel this plan"));
		}

		\dash\data::myPlan($planDetail['plan']);



	}
}

