<?php
namespace content_api\home;


class controller
{

	public static function routing()
	{
		if(\dash\url::root() === 'jibres')
		{
			\dash\redirect::to(\dash\url::api('developers'));
		}
		else
		{
			\dash\header::status(404);
			return;
		}

	}

}
?>