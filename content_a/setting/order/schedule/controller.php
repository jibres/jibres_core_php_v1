<?php
namespace content_a\setting\order\schedule;

class controller extends \content_a\setting\home\controller
{
	public static function routing()
	{
		parent::routing();

		\lib\app\factor\schedule_order::load();

	}
}
?>