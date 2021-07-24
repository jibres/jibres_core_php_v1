<?php
namespace content_a\accounting\year\vatsetting;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Quarterly tax report settings'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::accountingSettingSaved(\lib\app\setting\get::accounting_setting());

	}
}
?>
