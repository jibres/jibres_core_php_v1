<?php
namespace content_a\homepage\home;


class controller extends \content_a\pagebuilder\home\controller
{
	public static function routing()
	{
		\dash\temp::set('homepage_builder', true);

		parent::routing();
	}
}
?>