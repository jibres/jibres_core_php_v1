<?php
namespace content_a\setting\accounting;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Accounting setting'));

		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::accountingSettingSaved(\lib\app\setting\get::accounting_setting());
	}
}
?>