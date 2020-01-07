<?php
namespace content_a\setting\pcpos;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Setting'). ' | '. T_('Pos'));
		\dash\data::page_desc(T_('Change all settings of team and edit them to customize and have a good experience.'));

		\dash\data::dataTable(\lib\app\pos\datalist::list());


		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::this());
	}
}
?>