<?php
namespace content_a\form\find;


class controller
{
	public static function routing()
	{
		if(!\lib\app\form\form\get::enterpriseSpecialFormBuilder())
		{
			\dash\header::status(404);
		}


	}
}
?>
