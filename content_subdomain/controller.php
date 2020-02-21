<?php
namespace content_subdomain;

class controller
{
	public static function routing()
	{
		if(\dash\url::subdomain() === 'core')
		{
			if(\dash\url::module())
			{
				\dash\header::status(404);
			}

			\content_r10\home\view::config();
			return;
		}
		elseif(\dash\url::subdomain() === 'api')
		{
			if(\dash\url::module())
			{
				\dash\header::status(404);
			}

			\content_v2\home\view::config();
			return;
		}
		elseif(\dash\url::subdomain() === 'shop')
		{
			// this is special page for shop aname
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