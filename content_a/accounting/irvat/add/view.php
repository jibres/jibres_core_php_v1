<?php
namespace content_a\accounting\irvat\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Add new facotr"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '/all');

		\dash\data::titleList(\lib\app\irvat\get::title_list());

		self::static_var();
	}



	public static function static_var()
	{
		if(\dash\get::index(\dash\data::dataRow(), 'customer_detail', 'legal_detail', 'accounting_details_id'))
		{
			$load = \lib\app\tax\coding\get::get(\dash\get::index(\dash\data::dataRow(), 'customer_detail', 'legal_detail', 'accounting_details_id'));

			\dash\data::accountingDetailsId($load);
		}

		if(\dash\get::index(\dash\data::dataRow(), 'seller_detail', 'legal_detail', 'accounting_details_id'))
		{
			$load = \lib\app\tax\coding\get::get(\dash\get::index(\dash\data::dataRow(), 'seller_detail', 'legal_detail', 'accounting_details_id'));

			\dash\data::accountingDetailsId($load);
		}

		\dash\data::assistantList(\lib\app\tax\coding\get::list_of('assistant'));

	}
}
?>