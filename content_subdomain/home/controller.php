<?php
namespace content_subdomain\home;

class controller
{
	public static function routing()
	{
		if(\dash\url::subdomain() === 'source')
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