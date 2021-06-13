<?php
namespace content_a\accounting\report\ledger;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Ledger"). ' - '. T_("Monthly"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::userToggleSidebar(false);

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

		$startdate = \dash\request::get('startdate');
		$startdate = \dash\validate::date($startdate, false);
		$enddate = \dash\request::get('enddate');
		$enddate = \dash\validate::date($enddate, false);

		$args              = [];
		$args['year_id']   = $year_id;
		$args['startdate'] = $startdate ? $startdate : null;
		$args['enddate']   = $enddate ? $enddate : null;
		$args['daily']   = \dash\request::get('daily') ? true : false;



		$report = \lib\app\tax\doc\report\journal::ledger($args);

		\dash\data::reportDetail($report);

		$last_page = 1;

		$per_page = [];

		foreach ($report as $key => $value)
		{

			if(isset($value['page']))
			{
				$last_page = $value['page'];
			}

			if(!isset($per_page[$last_page]))
			{
				$per_page[$last_page] = [];
			}

			$per_page[$last_page][] = $value;

		}


		\dash\data::reportPerPage($per_page);

		// if(\dash\request::get('export'))
		// {
		// 	$export_name = "Accounting_report_total";
		// 	foreach ($report as $key => $value)
		// 	{
		// 		unset($report[$key]['string_id']);
		// 	}

		// 	\dash\utility\export::csv(['name' => $export_name, 'data' => \dash\data::reportDetail()]);
		// }

	}

}
?>
