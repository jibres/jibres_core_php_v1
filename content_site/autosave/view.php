<?php
namespace content_site\autosave;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting auto-save and publish'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::include_adminPanelBuilder(true);
	}
}
?>