<?php
namespace content_a\plan\set;


class controller
{

	public static function routing()
	{
		$plan = \dash\url::subchild();

		if (!in_array($plan, \lib\app\plan\planList::list()))
		{
			\dash\header::status(404, T_("Invalid plan name"));
		}

		\dash\data::planName($plan);

		if($plan === 'free')
		{
			\dash\header::status(404, T_("Plan free can not be loaded on this page"));
		}


		\dash\open::get();
		\dash\open::post();


	}

}

