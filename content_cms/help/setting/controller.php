<?php
namespace content_cms\help\setting;


class controller extends \content_cms\posts\setting\controller
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