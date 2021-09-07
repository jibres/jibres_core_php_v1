<?php
namespace lib\jpi;


class budget
{
	public static function me()
	{
		features::pay(['features' => ['site_body_blog_b4']]);

		$budget = jpi::budget();

		if(isset($budget['budget']))
		{
			return $budget;
		}

		return false;

	}
}
?>