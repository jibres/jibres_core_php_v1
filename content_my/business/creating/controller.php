<?php
namespace content_my\business\creating;


class controller
{
	public static function routing()
	{
		if(!\dash\session::get('createNewStore_subdomain', 'CreateNewStore'))
		{
			\dash\redirect::to(\dash\url::this(). '/subdomain');
		}
	}
}
?>
