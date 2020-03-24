<?php
namespace content_a\setting\general;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Setting'). ' | '. T_('General'));
	}
}
?>