<?php
namespace content_a\setting\pcpos;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Setting'). ' | '. T_('Pos'));
		\dash\data::page_desc(T_('Change all settings of team and edit them to customize and have a good experience.'));

		\dash\data::dataTable(\lib\app\pos\datalist::list());

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>