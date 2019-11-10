<?php
namespace content_store\error;


class controller
{
	public static function routing()
	{
		if(!\dash\session::get('createNewStore_error', 'CreateNewStore'))
		{
			\dash\redirect::to(\dash\url::here());
		}
	}
}
?>
