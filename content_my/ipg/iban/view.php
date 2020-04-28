<?php
namespace content_my\ipg\iban;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Bank account number'));


		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		// btn
		\dash\data::action_text(T_('Add new IBAN'));
		\dash\data::action_icon('plus');
		\dash\data::action_link(\dash\url::that(). '/add');

		$dataTable = \lib\app\ipg\iban\get::my_iban();

		\dash\data::dataTable($dataTable);
	}
}
?>