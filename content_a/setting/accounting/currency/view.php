<?php
namespace content_a\setting\accounting\currency;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Accounting currency setting'));

		// back
		\dash\data::back_text(T_('Accounting setting'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::accountingSettingSaved(\lib\app\setting\get::accounting_setting());

	}
}
?>