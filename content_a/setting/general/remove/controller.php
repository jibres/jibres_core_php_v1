<?php
namespace content_a\setting\general\remove;

class controller extends \content_a\setting\home\controller
{
	public static function routing()
	{
		parent::routing();

		\dash\permission::access('settingBusinessEdit');

		\dash\csrf::set();

	}
}
?>