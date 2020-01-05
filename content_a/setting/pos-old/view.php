<?php
namespace content_a\setting\pos;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Setting'). ' | '. T_('Pos'));
		\dash\data::page_desc(T_('Change all settings of team and edit them to customize and have a good experience.'));
		$pos = \lib\store::detail('pos');
		if(is_string($pos))
		{
			$pos = json_decode($pos, true);
		}

		\dash\data::dataTable($pos);
	}
}
?>