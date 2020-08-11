<?php
namespace content_a\website\body;


class model
{
	public static function post()
	{

		$bodyline = \dash\request::post('bodyline');

		if($bodyline && is_array($bodyline))
		{
			\lib\app\website\body\edit::set_sort($bodyline);
		}
		else
		{
			\dash\notif::error(T_("No sort data received"));
		}




	}
}
?>
