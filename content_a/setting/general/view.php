<?php
namespace content_a\setting\general;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Setting'). ' | '. T_('General'));
		\dash\data::page_desc(T_('Change all settings of team and edit them to customize and have a good experience.'));
	}
}
?>