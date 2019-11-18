<?php
namespace content_cms;

class controller
{

	public static function routing()
	{
		\dash\redirect::to_login();

		\dash\permission::access('contentCp');

	}
}
?>