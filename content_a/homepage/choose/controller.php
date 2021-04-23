<?php
namespace content_a\homepage\choose;


class controller extends \content_a\pagebuilder\choose\controller
{
	public static function routing()
	{
		\dash\temp::set('homepage_builder', true);

		parent::routing();
	}
}
?>