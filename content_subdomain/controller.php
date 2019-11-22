<?php
namespace content_subdomain;

class controller
{
	public static function routing()
	{
		if(in_array(\dash\url::subdomain(), ['developers']))
		{

		}
		else
		{
			if(!\lib\store::id())
			{
				\dash\header::status(404, T_("Store not found"));
			}
		}
	}
}
?>