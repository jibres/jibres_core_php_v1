<?php
namespace content_a\accounting\report\detail;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Accounting report detail'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

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

		$report = \lib\app\tax\doc\report::detail_report($args);
		\dash\data::reportDetail($report);

	}

}
?>
