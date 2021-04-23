<?php
namespace content_a\homepage\add;


class controller extends \content_a\pagebuilder\add\controller
{
	public static function routing()
	{
		\dash\temp::set('homepage_builder', true);

		parent::routing();
	}
}
?>