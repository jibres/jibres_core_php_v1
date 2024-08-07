<?php
namespace content_a\report\productsalesovertime;

class view
{
	public static function config()
	{
		\dash\permission::access('_group_setting');

		\dash\face::title(T_('Product sales reports'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$type      = \dash\request::get('type');
		$date      = \dash\request::get('date');
		$startdate = \dash\request::get('startdate');
		$enddate   = \dash\request::get('enddate');
		$year      = \dash\request::get('year');
		$month     = \dash\request::get('month');
		$starttime = \dash\request::get('starttime');
		$endtime   = \dash\request::get('endtime');
		$sort      = \dash\request::get('sort');
		$product   = \dash\request::get('product');


		if(!$type)
		{
			$type = 'date';
		}

		if(!$starttime)
		{
			$starttime = '00:00:00';
		}

		if(!$endtime)
		{
			$endtime = '23:59:59';
		}

		switch ($type)
		{

			case 'date':
				\dash\face::title(T_('Product sales report in date'));

				if(!$date)
				{
					$date = \dash\fit::date_en(date("Y-m-d"));
				}

				break;

			case 'period':

				\dash\face::title(T_('Product sales reports over time'));

				if(!$startdate)
				{
					$startdate = \dash\fit::date_en(date("Y-m-d", strtotime('-7 days')));
				}

				if(!$enddate)
				{
					$enddate = \dash\fit::date_en(date("Y-m-d"));
				}

				break;

			case 'year':
				\dash\face::title(T_('Product sales reports over year'));

				if(!$year)
				{
					$year = substr(\dash\fit::date_en(date("Y-m-d")), 0, 4);
				}

				$year_list = \lib\app\order\get::year_list();

				\dash\data::yearList($year_list);
				break;

			case 'month':
				\dash\face::title(T_('Product sales reports over month'));

				if(!$year)
				{
					$year = substr(\dash\fit::date_en(date("Y-m-d")), 0, 4);
				}

				$year_list = \lib\app\order\get::year_list();

				\dash\data::yearList($year_list);

				if(!$month)
				{
					$month = substr(\dash\fit::date_en(date("Y-m-d")), 5, 2);
				}
				break;

			default:
				// code...
				break;
		}



		$args =
		[
			'groupby'   => 'product',
			'type'      => $type,
			// 'product'   => $product,
			'date'      => $date,
			'startdate' => $startdate,
			'enddate'   => $enddate,
			'year'      => $year,
			'month'     => $month,
			'starttime' => $starttime,
			'endtime'   => $endtime,
			'sort'      => $sort,
		];

		$result = \lib\app\product\report\sale_date::get_list($args);

		if(isset($result['list']))
		{

			\dash\data::dataTable($result['list']);

			if($result['list'] && is_array($result['list']))
			{
				if(floatval(array_sum(array_column($result['list'], 'vat'))) === floatval(0))
				{
					// \dash\data::hiddenVat(true);
				}
			}
		}

		if(isset($result['summary']))
		{
			\dash\data::summaryDetail($result['summary']);
		}

		if(isset($result['plugin']))
		{
			\dash\data::pluginDetail($result['plugin']);
		}


		\dash\data::myArgs($args);


		\dash\data::sortList(\lib\app\product\report\sale_date::sort_list('product'));



	}
}
?>