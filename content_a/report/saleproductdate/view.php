<?php
namespace content_a\report\saleproductdate;

class view
{
	public static function config()
	{
		\dash\permission::access('_group_setting');

		\dash\face::title(T_('Sale Product per date'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$date      = \dash\request::get('date');
		$startdate = \dash\request::get('startdate');
		$enddate   = \dash\request::get('enddate');
		$type      = \dash\request::get('type');

		if(!$date)
		{
			$date = \dash\fit::date_en(date("Y-m-d"));
		}

		if(!$type)
		{
			$type = 'date';
		}

		if(!$startdate)
		{
			$startdate = \dash\fit::date_en(date("Y-m-d", strtotime('-7 days')));
		}

		if(!$enddate)
		{
			$enddate = \dash\fit::date_en(date("Y-m-d"));
		}


		$args =
		[
			'type'      => $type,
			'date'      => $date,
			'startdate' => $startdate,
			'enddate'   => $enddate,
		];

		$result = \lib\app\product\report\sale_date::get_list($args);

		\dash\data::dataTable($result);


		\dash\data::myArgs($args);

	}
}
?>