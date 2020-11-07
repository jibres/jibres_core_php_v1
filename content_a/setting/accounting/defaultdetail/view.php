<?php
namespace content_a\setting\accounting\defaultdetail;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Accounting currency setting'));

		// back
		\dash\data::back_text(T_('Accounting setting'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::accountingSettingSaved(\lib\app\setting\get::accounting_setting());

		\dash\data::assistantList(\lib\app\tax\coding\get::list_of('assistant'));

	}
}
?>