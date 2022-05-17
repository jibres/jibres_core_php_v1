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

		$type      = \dash\request::get('type');
		$date      = \dash\request::get('date');
		$startdate = \dash\request::get('startdate');
		$enddate   = \dash\request::get('enddate');
		$year      = \dash\request::get('year');


		if(!$type)
		{
			$type = 'date';
		}

		if($type === 'date' && !$date)
		{
			$date = \dash\fit::date_en(date("Y-m-d"));
		}


		if($type === 'period')
		{
			if(!$startdate)
			{
				$startdate = \dash\fit::date_en(date("Y-m-d", strtotime('-7 days')));
			}

			if(!$enddate)
			{
				$enddate = \dash\fit::date_en(date("Y-m-d"));
			}
		}

		if($type === 'year')
		{
			if(!$year)
			{
				$year = substr(\dash\fit::date_en(date("Y-m-d")), 0, 4);
			}

			$year_list = \lib\app\order\get::year_list();

			\dash\data::yearList($year_list);
		}




		$args =
		[
			'type'      => $type,
			'date'      => $date,
			'startdate' => $startdate,
			'enddate'   => $enddate,
			'year'      => $year,
		];

		$result = \lib\app\product\report\sale_date::get_list($args);

		\dash\data::dataTable($result);


		\dash\data::myArgs($args);



	}
}
?>