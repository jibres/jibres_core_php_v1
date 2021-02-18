<?php
namespace content_cms;

class controller
{

	public static function routing()
	{
		if(!\dash\url::store())
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		if(!\lib\store::id())
		{
			\dash\header::status(404, T_("Store not found"));
		}

		\dash\redirect::to_login();

		\dash\permission::access('_group_cms');
	}
}
?>