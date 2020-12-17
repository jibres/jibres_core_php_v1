<?php
namespace content_cms\help\redirecturl;

class controller extends \content_cms\posts\redirecturl\controller
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