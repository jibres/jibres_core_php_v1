<?php
namespace content_a\accounting\report\journal;


class view
{
	public static function config()
	{
		\dash\permission::access('_group_accounting');
		\dash\face::title(T_("General Journal"). ' - '. T_("Monthly"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

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

		foreach ($year as $key => $value)
		{
			if(isset($value['id']) && $value['id'] == $year_id)
			{
				\dash\data::currentYearDetail($value);
			}
		}

		$startdate = \dash\request::get('startdate');
		$startdate = \dash\validate::date($startdate, false);
		$enddate = \dash\request::get('enddate');
		$enddate = \dash\validate::date($enddate, false);

		$args              = [];
		$args['year_id']   = $year_id;
		$args['daily']   = \dash\request::get('daily') ? true : false;
		$args['startdate'] = $startdate ? $startdate : null;
		$args['enddate']   = $enddate ? $enddate : null;


		$report = \lib\app\tax\doc\report\journal::report($args);

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


		\dash\data::reportDetail($report);

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
