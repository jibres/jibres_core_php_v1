<?php

namespace content_a\plan\renew;


class controller
{

	public static function routing()
	{

		$planDetail = \lib\app\plan\businessPlanDetail::getMyCurrentPlanDetail();


		if (!isset($planDetail['plan']))
		{
			\dash\header::status(404, T_("Plan Not found"));
		}

		if (isset($planDetail['canRenew']) && $planDetail['canRenew'])
		{
			$url         = \dash\url::this() . '/set/' . $planDetail['plan'];
			$queryString = [];
			if (isset($planDetail['periodtype']))
			{
				$queryString['p'] = $planDetail['periodtype'];
			}

			$queryString['renew'] = 1;

			$url .= '?' . \dash\request::build_query($queryString);

			\dash\redirect::to($url);

		}
		else
		{
			\dash\header::status(403, T_("At this time you can not renew this plan"));
		}


	}

}

