<?php
namespace content_my\ipg\wallet;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Bank account number'));


		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		// btn
		\dash\data::action_text(T_('Add new Wallet'));
		\dash\data::action_icon('plus');
		\dash\data::action_link(\dash\url::that(). '/add');

		$dataTable = \lib\app\ipg\wallet\get::my_wallet();

		\dash\data::dataTable($dataTable);
	}
}
?>