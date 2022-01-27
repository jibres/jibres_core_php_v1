<?php
namespace content_cms;

class controller
{

	public static function routing()
	{
		\dash\engine\store::gate('cms');

		\dash\redirect::to_login();

		\dash\permission::access('_group_cms');
	}
}
?>