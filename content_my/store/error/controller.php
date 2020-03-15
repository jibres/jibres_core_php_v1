<?php
namespace content_my\store\error;


class controller
{
	public static function routing()
	{
		if(!\dash\session::get('createNewStore_error', 'CreateNewStore'))
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>
