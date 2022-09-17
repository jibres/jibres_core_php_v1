<?php
namespace lib\app\product\report;


class sale_date
{
	public static function sort_list($_type = null, $_need = null)
	{
		$sort_list =
		[
			['key' => 'datedesc', 		'sort' => 'order_date',			'order' => 'DESC', 		'title' => T_("Order date DESC"),	 		'type' => ['date']],
			['key' => 'dateasc', 		'sort' => 'order_date',			'order' => 'ASC', 		'title' => T_("Order date ASC"), 			'type' => ['date']],

			['key' => 'countorderdesc', 'sort' => 'count', 				'order' => 'DESC', 		'title' => T_("Count orders DESC"), 		'type' => ['date', 'product']],
			['key' => 'countorderasc', 	'sort' => 'count', 				'order' => 'ASC', 		'title' => T_("Count orders ASC"), 			'type' => ['date', 'product']],

			['key' => 'pricedesc', 		'sort' => 'price',	 			'order' => 'DESC', 		'title' => T_("Gross sales DESC"), 			'type' => ['date', 'product']],
			['key' => 'priceasc', 		'sort' => 'price',	 			'order' => 'ASC', 		'title' => T_("Gross sales ASC"), 			'type' => ['date', 'product']],

			['key' => 'vatdesc', 		'sort' => 'vat',	 			'order' => 'DESC', 		'title' => T_("VAT DESC"), 					'type' => ['date', 'product']],
			['key' => 'vatasc', 		'sort' => 'vat',	 			'order' => 'ASC', 		'title' => T_("VAT ASC"), 					'type' => ['date', 'product']],

			['key' => 'discountdesc', 	'sort' => 'discount',	 		'order' => 'DESC', 		'title' => T_("Discounts DESC"), 			'type' => ['date', 'product']],
			['key' => 'discountasc', 	'sort' => 'discount',	 		'order' => 'ASC', 		'title' => T_("Discounts ASC"), 			'type' => ['date', 'product']],

			['key' => 'qtydesc', 		'sort' => 'qty', 				'order' => 'DESC', 		'title' => T_("Ordered quantity DESC"), 	'type' => ['date', 'product']],
			['key' => 'qtyasc', 		'sort' => 'qty', 				'order' => 'ASC', 		'title' => T_("Ordered quantity ASC"), 		'type' => ['date', 'product']],

			['key' => 'sumdesc', 		'sort' => 'sum',	 			'order' => 'DESC', 		'title' => T_("Total sales DESC"), 			'type' => ['date', 'product']],
			['key' => 'sumasc', 		'sort' => 'sum',	 			'order' => 'ASC', 		'title' => T_("Total sales ASC"), 			'type' => ['date', 'product']],

		];

		if($_type)
		{
			$new_list = [];

			foreach ($sort_list as $key => $value)
			{
				if(in_array($_type, $value['type']))
				{
					$new_list[] = $value;
				}
			}

			$sort_list = $new_list;
		}

		if($_need)
		{
			foreach ($sort_list as $key => $value)
			{
				if($_need === $value['key'])
				{
					return $value;
				}
			}

			return false;
		}



		return $sort_list;
	}


	/**
	 * Get list of sale product per date
	 *
	 * @param      array  $_args  The arguments
	 */
	public static function get_list(array $_args)
	{
		$condition =
		[
			'groupby'   => ['enum' => ['product', 'date']],
			'type'      => ['enum' => ['date', 'week', 'month', 'year', 'period']],
			'sort'      => ['enum' => array_column(self::sort_list(), 'key')],
			'date'      => 'date',
			'product'   => 'id',
			'startdate' => 'date',
			'enddate'   => 'date',
			'year'      => 'intstring_4',
			'month'     => 'intmonth',
			'starttime' => 'time',
			'endtime'   => 'time',
		];

		$require = ['type'];

		if(a($_args, 'type') === 'period')
		{
			$require[] = 'startdate';
			$require[] = 'enddate';
		}

		if(a($_args, 'type') === 'year')
		{
			$require[] = 'year';
		}

		if(a($_args, 'type') === 'month')
		{
			$require[] = 'year';
			$require[] = 'month';
		}

		$meta    =
		[
			'field_title' =>
			[
				'startdate' => T_("Start date"),
				'enddate' => T_("End date"),
			],
		];

		$args    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$starttime = $data['starttime'];
		$endtime   = $data['endtime'];

		$sort  = 'count';
		$order = 'DESC';

		if($data['sort'])
		{
			$sort_detail = self::sort_list($data['groupby'], $data['sort']);

			if(a($sort_detail, 'sort'))
			{
				$sort = $sort_detail['sort'];
			}

			if(a($sort_detail, 'order'))
			{
				$order = $sort_detail['order'];
			}
		}


		$args['sort']    = $sort;
		$args['order']   = $order;
		$args['groupby'] = $data['groupby'];

		$ready_to_load_report = false;

		if($data['product'])
		{
			$args['product'] = $data['product'];
		}


		$result = [];

		$advance_report = true;

		if(!\lib\app\plan\planCheck::access('professionalReport') && $data['type'] !== 'date')
		{
			$advance_report = false;

		}

		switch ($data['type'])
		{
			case 'date':
				$args['startdate']    = $data['date'] . ' '. $starttime;
				$args['enddate']      = $data['date'] . ' '. $endtime;
				$ready_to_load_report = true;
				break;

			case 'period':
				if($data['startdate'] && $data['enddate'])
				{
					$args['startdate']    = $data['startdate'] . ' '. $starttime;
					$args['enddate']      = $data['enddate'] . ' '. $endtime;
					$ready_to_load_report = true;
				}
				break;

			case 'month':
				if($data['month'] && $data['year'])
				{
					$start_month = date($data['year']. '-'. $data['month']. '-01');

					if(\dash\language::current() === 'fa')
					{
						if($data['month'] <= 6)
						{
							$end_month   = $data['year']. '-'. $data['month']. '-31';
						}
						else
						{
							$end_month   = $data['year']. '-'. $data['month']. '-30';

							if(intval($data['month']) === 12)
							{
								$end_of_year = \dash\utility\jdate::day_of_end_of_year($data['year']);

								$end_month   = $data['year']. '-'. $data['month']. '-'. $end_of_year;
							}
						}
					}
					else
					{
						$end_month   = date($data['year']. '-'. $data['month']. '-t');
					}

					$args['startdate']    = \dash\validate::date($start_month) . ' 00:00:00';
					$args['enddate']      = \dash\validate::date($end_month) . ' 23:59:59';
					$ready_to_load_report = true;
				}
				break;

			case 'year':
				if($data['year'])
				{
					$end_of_year = \dash\utility\jdate::day_of_end_of_year($data['year']);

					$start_year = $data['year']. '-01-01 '. $starttime;
					$end_year   = $data['year']. "-12-$end_of_year ". $endtime;

					$args['startdate']    = \dash\validate::date($start_year) . ' 00:00:00';
					$args['enddate']      = \dash\validate::date($end_year) . ' 23:59:59';
					$ready_to_load_report = true;
				}
				break;

			default:
				$ready_to_load_report = false;
				break;
		}


		if($ready_to_load_report && $advance_report)
		{
			if($data['groupby'] === 'product')
			{
				$result = \lib\db\products\report\get::product_sales_over_time($args);
			}
			elseif($data['groupby'] === 'date')
			{
				$result = \lib\db\products\report\get::sales_over_time($args);
			}
		}

		if($data['product'])
		{
			$load_product = \lib\app\product\get::inline_get($data['product']);

			if($load_product && is_array(a($result, 'summary')))
			{

				$result['summary']['producttitle'] = a($load_product, 'title');
				$result['summary']['productid'] = a($load_product, 'id');
			}
		}

		if(!$advance_report)
		{
			$result['plugin'] =
			[
				'title' => \lib\app\plan\planMessage::needUpgrade(),
				'link' => \lib\app\plan\planMessage::getLink(),
			];
		}


		return $result;

	}
}
?>