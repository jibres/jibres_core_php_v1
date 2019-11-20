<?php
namespace content_a\setup\home;


class controller
{
	public static function routing()
	{
		$complete = \lib\app\setting\setup::complete();
		if($complete)
		{
			$url = \dash\url::here();
			\dash\redirect::to($url);
		}
		else
		{
			$child = \lib\app\setting\setup::next_level();
			if($child)
			{
				$url = \dash\url::this(). '/'. $child;
				\dash\redirect::to($url);
			}
			else
			{
				\lib\app\setting\setup::complete(true);
				$url = \dash\url::here();
				\dash\redirect::to($url);
			}
		}


	}
}
?>
