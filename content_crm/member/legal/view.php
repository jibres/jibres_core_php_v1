<?php
namespace content_crm\member\legal;


class view
{
	public static function config()
	{
		\content_crm\member\main\view::dataRowMember();

		\dash\face::title(T_('Edit user legal detail'));

		\content_crm\member\main\view::static_var();

		\dash\data::dataRowLegal(\dash\app\user\legal::get(\dash\request::get('id')));

		\dash\data::assistantList(\lib\app\tax\coding\get::list_of('assistant'));

		if(\dash\get::index(\dash\data::dataRowLegal(), 'accounting_details_id'))
		{
			$load = \lib\app\tax\coding\get::get(\dash\get::index(\dash\data::dataRowLegal(), 'accounting_details_id'));
			\dash\data::accountingDetailsId($load);
		}
	}
}
?>