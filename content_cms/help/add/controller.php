<?php
namespace content_cms\help\add;

class controller extends \content_cms\posts\add\controller
{
	public static function routing()
	{
		parent::routing();

		if(\dash\engine\store::inStore())
		{
			\dash\header::status(404, T_("Invalid post type"));
		}
	}
}
?>