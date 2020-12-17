<?php
namespace content_cms\help\gallerysort;

class controller extends \content_cms\posts\gallerysort\controller
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