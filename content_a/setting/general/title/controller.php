<?php
namespace content_a\setting\general\title;

class controller extends \content_a\setting\home\controller
{
	public static function routing()
	{
		parent::routing();

		\dash\csrf::set();

		\dash\permission::access('settingEdit');

	}
}
?>