<?php
namespace content_store\opening;


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
