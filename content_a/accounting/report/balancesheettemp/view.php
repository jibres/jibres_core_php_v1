<?php
namespace content_a\accounting\report\balancesheettemp;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Balance Sheet temp report in group level'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::userToggleSidebar(false);

		$year = \lib\app\tax\year\get::list();
		\dash\data::accountingYear($year);

		\dash\face::btnExport(\dash\url::current(). '?'. \dash\request::fix_get(['export' => 1]));

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

		$report = \lib\app\tax\doc\report::group_report_balancesheet_temp($args);
		\dash\data::reportDetail($report);

		if(\dash\request::get('export'))
		{
			$export_name = "Accounting_report_group";


			\dash\utility\export::csv(['name' => $export_name, 'data' => $report]);
		}

	}

}
?>
