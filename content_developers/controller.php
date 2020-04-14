<?php
namespace content_developers;

class controller
{
	public static function routing()
	{
		if(!\dash\url::subdomain())
		{
			\dash\redirect::to(\dash\url::api('developers'), false);
		}
		elseif(\dash\url::subdomain() !== 'developers')
		{
			if(\dash\url::module())
			{
				\dash\header::status(404);
			}

			\dash\redirect::to(\dash\url::api('developers'), false);
		}
	}
}
?>