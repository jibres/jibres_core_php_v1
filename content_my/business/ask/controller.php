<?php
namespace content_my\business\ask;


class controller
{
	public static function routing()
	{
		if(!\dash\session::get('createNewStore_title', 'CreateNewStore'))
		{
			\dash\redirect::to(\dash\url::here(). '/start');
		}
	}
}
?>
