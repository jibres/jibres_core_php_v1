<?php
namespace content_a\setting\social;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Setting'). ' | '. T_('Social'));
		// \dash\data::page_desc(T_('Change all settings of team and edit them to customize and have a good experience.'));

		$socialnetwork = \lib\store::detail('socialnetwork');

		if(is_string($socialnetwork))
		{
			$socialnetwork = json_decode($socialnetwork, true);
		}

		\dash\data::dataRow($socialnetwork);
	}
}
?>