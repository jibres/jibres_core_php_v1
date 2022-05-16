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

		$date = \dash\request::get('date');
		if(!$date)
		{
			$date = \dash\fit::date_en(date("Y-m-d"));
		}

		\dash\data::currentDate($date);

		$startdate = \dash\request::get('startdate');
		$enddate   = \dash\request::get('enddate');

		$args =
		[
			'type'      => 'date',
			'type'      => 'period',
			'date'      => $date,
			'startdate' => $startdate,
			'enddate'   => $enddate,
		];

		$result = \lib\app\product\report\sale_date::get_list($args);

		\dash\data::dataTable($result);



	}
}
?>