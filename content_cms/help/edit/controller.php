<?php
namespace content_cms\help\edit;

class controller extends \content_cms\posts\edit\controller
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