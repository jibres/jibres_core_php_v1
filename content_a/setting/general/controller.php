<?php
namespace content_a\setting\general;

class controller extends \content_a\setting\home\controller
{
	public static function routing()
	{
		parent::routing();

		\dash\permission::access('settingBusinessEdit');

		\dash\allow::file();

	}
}
?>