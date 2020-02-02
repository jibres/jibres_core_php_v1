<?php
namespace content_subdomain;

class controller
{
	public static function routing()
	{
		if(\dash\url::subdomain() === 'core')
		{
			\content_r10\home\view::config();
			return;
		}
		elseif(in_array(\dash\url::subdomain(), ['developers']))
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