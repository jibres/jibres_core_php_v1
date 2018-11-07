<?php
namespace content_a\setting\factor;

class view
{
	public static function config()
	{
		\dash\permission::access('settingEdit');

		\dash\data::page_title(T_('Setting'). ' | '. T_('Factor'));
		\dash\data::page_desc(T_('Change all settings of team and edit them to customize and have a good experience.'));
	}
}
?>