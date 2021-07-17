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

		\dash\data::userToggleSidebar(false);

		self::static_var();
	}



	public static function static_var()
	{
		if(a(\dash\data::dataRow(), 'customer_detail', 'legal_detail', 'accounting_details_id'))
		{
			$load = \lib\app\tax\coding\get::get(a(\dash\data::dataRow(), 'customer_detail', 'legal_detail', 'accounting_details_id'));

			\dash\data::accountingDetailsId($load);
		}

		if(a(\dash\data::dataRow(), 'seller_detail', 'legal_detail', 'accounting_details_id'))
		{
			$load = \lib\app\tax\coding\get::get(a(\dash\data::dataRow(), 'seller_detail', 'legal_detail', 'accounting_details_id'));

			\dash\data::accountingDetailsId($load);
		}


		$year = \lib\app\tax\year\get::list();
		\dash\data::accountingYear($year);

		$year_id = \dash\request::get('year_id');
		if(!$year_id)
		{
			foreach ($year as $key => $value)
			{
				if(isset($value['isdefault']) && $value['isdefault'])
				{
					$year_id = $value['id'];
					break;
				}
			}
		}

		\dash\data::detailsList(\lib\app\tax\coding\get::current_list_of('details'));


	}
}
?>