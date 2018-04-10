<?php
namespace content_a\setting\home;

class view
{

	public static function config()
	{
		// simply set title of child, if needed change it in config of them
		\dash\data::page_title(T_('Setting'));
		\dash\data::page_desc(T_('Change all settings of team and edit them to customize and have a good experience.'));
	}
}
?>