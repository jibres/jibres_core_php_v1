<?php
namespace content_developers;

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

			\dash\redirect::to(\dash\url::api('developers'));
		}
		elseif(\dash\url::subdomain() === 'api')
		{
			if(\dash\url::module())
			{
				\dash\header::status(404);
			}

			\dash\redirect::to(\dash\url::api('developers'));
		}
	}
}
?>