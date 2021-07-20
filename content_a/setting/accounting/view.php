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

		\dash\data::assistantList(\lib\app\tax\coding\get::list_of('assistant'));
		\dash\data::detailsList(\lib\app\tax\coding\get::current_list_of('details'));


		\dash\data::currencyList(\lib\currency::list());
	}
}
?>