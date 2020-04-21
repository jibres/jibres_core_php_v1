<?php
namespace content_my\business\subdomain;


class controller
{
	public static function routing()
	{
		if(!\dash\session::get('createNewStore_title', 'CreateNewStore'))
		{
			\dash\redirect::to(\dash\url::this(). '/start');
		}
	}
}
?>
