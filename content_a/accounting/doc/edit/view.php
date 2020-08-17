<?php
namespace content_a\accounting\doc\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit accounting doc'). ' #'. \dash\data::dataRow_number(). ' - '. T_("Status"). ' '. T_(\dash\data::dataRow_status()));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		\dash\data::myType(\dash\data::dataRow_type());
		\dash\data::editMode(true);

		\dash\data::assistantList(\lib\app\tax\coding\get::list_of('assistant'));
		\dash\data::detailsList(\lib\app\tax\coding\get::list_of('details'));

		$detail = \lib\app\tax\docdetail\get::list(\dash\request::get('id'));
		\dash\data::docDetail($detail);

		\dash\data::accountingYear(\lib\app\tax\year\get::list());

		if($detail && is_array($detail))
		{
			$summary = [];
			$summary['debtor'] = array_sum(array_column($detail, 'debtor'));
			$summary['creditor'] = array_sum(array_column($detail, 'creditor'));
			\dash\data::summary($summary);
		}

	}
}
?>
