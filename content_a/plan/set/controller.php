<?php
namespace content_a\plan\set;


class controller
{
	public static function routing()
	{
		$plan = \dash\url::subchild();

		if(!in_array($plan, \lib\app\plan\planList::list()))
		{
			\dash\header::status(404, T_("Invalid plan name"));
		}

        \dash\data::planName($plan);


        \dash\open::get();
        \dash\open::post();


	}
}

