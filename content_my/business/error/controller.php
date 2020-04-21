<?php
namespace content_my\business\error;


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
