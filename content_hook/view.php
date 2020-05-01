<?php
namespace content_hook;

class view
{
	public static function config()
	{

		\dash\data::include_adminPanel(false);
		\dash\data::include_editor(false);
	}
}
?>