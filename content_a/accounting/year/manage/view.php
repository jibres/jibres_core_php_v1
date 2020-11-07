<?php
namespace content_a\accounting\year\manage;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage year'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		\dash\face::btnSetting(\dash\url::here(). '/setting/accounting/defaultdetail');

		\dash\data::accountingSettingSaved(\lib\app\setting\get::accounting_setting());


		$close_harmful_profit = \lib\app\tax\doc\closing::list_harmful_profit(\dash\request::get('id'));

		\dash\data::closeHarmfullProfitList($close_harmful_profit);

	}
}
?>
