<?php
namespace content_a\setting\general\nosale;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Saleing'));


		\dash\data::nosaleSettingSaved(\lib\app\setting\get::nosale_setting());

		// back
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::that());
	}
}
?>