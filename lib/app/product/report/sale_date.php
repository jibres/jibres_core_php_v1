<?php
namespace lib\app\product\report;


class sale_date
{
	public static function sort_list($_need = null)
	{
		$sort_list =
		[

			['key' => 'countorderdesc', 'sort' => 'count', 				'order' => 'DESC', 		'title' => T_("Count order DESC")],
			['key' => 'countorderasc', 	'sort' => 'count', 				'order' => 'ASC', 		'title' => T_("Count order ASC")],

			['key' => 'pricedesc', 		'sort' => 'price',	 			'order' => 'DESC', 		'title' => T_("Price DESC")],
			['key' => 'priceasc', 		'sort' => 'price',	 			'order' => 'ASC', 		'title' => T_("Price ASC")],

			['key' => 'vatdesc', 		'sort' => 'vat',	 			'order' => 'DESC', 		'title' => T_("VAT DESC")],
			['key' => 'vatasc', 		'sort' => 'vat',	 			'order' => 'ASC', 		'title' => T_("VAT ASC")],

			['key' => 'discountdesc', 	'sort' => 'discount',	 		'order' => 'DESC', 		'title' => T_("Discount DESC")],
			['key' => 'discountasc', 	'sort' => 'discount',	 		'order' => 'ASC', 		'title' => T_("Discount ASC")],

			['key' => 'finalpricedesc', 'sort' => 'finalprice',			'order' => 'DESC', 		'title' => T_("Final price DESC")],
			['key' => 'finalpriceasc', 	'sort' => 'finalprice',			'order' => 'ASC', 		'title' => T_("Final price ASC")],

			['key' => 'qtydesc', 		'sort' => 'qty', 				'order' => 'DESC', 		'title' => T_("Qty DESC")],
			['key' => 'qtyasc', 		'sort' => 'qty', 				'order' => 'ASC', 		'title' => T_("Qty ASC")],

			['key' => 'sumdesc', 		'sort' => 'sum',	 			'order' => 'DESC', 		'title' => T_("Sum DESC")],
			['key' => 'sumasc', 		'sort' => 'sum',	 			'order' => 'ASC', 		'title' => T_("Sum ASC")],

		];

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
			'type'      => ['enum' => ['date', 'week', 'month', 'year', 'period']],
			'sort'      => ['enum' => array_column(self::sort_list(), 'key')],
			'date'      => 'date',
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
			$sort_detail = self::sort_list($data['sort']);

			if(a($sort_detail, 'sort'))
			{
				$sort = $sort_detail['sort'];
			}

			if(a($sort_detail, 'order'))
			{
				$order = $sort_detail['order'];
			}
		}

		$args['sort']  = $sort;
		$args['order'] = $order;


		$result = [];

		switch ($data['type'])
		{
			case 'date':
				$args['startdate'] = $data['date'] . ' '. $starttime;
				$args['enddate']   = $data['date'] . ' '. $endtime;
				$result = \lib\db\products\report\get::sale_in_date($args);
				break;

			case 'period':
				if($data['startdate'] && $data['enddate'])
				{
					$args['startdate'] = $data['startdate'] . ' '. $starttime;
					$args['enddate']   = $data['enddate'] . ' '. $endtime;
					$result = \lib\db\products\report\get::sale_in_date($args);
				}
				break;

			case 'year':
				if($data['year'])
				{
					$end_of_year = \dash\utility\jdate::day_of_end_of_year($data['year']);

					$start_year = $data['year']. '-01-01 '. $starttime;
					$end_year   = $data['year']. "-12-$end_of_year ". $endtime;

					$args['startdate'] = \dash\validate::date($start_year) . ' 00:00:00';
					$args['enddate']   = \dash\validate::date($end_year) . ' 23:59:59';

					$result = \lib\db\products\report\get::sale_in_date($args);
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

					$args['startdate'] = \dash\validate::date($start_month) . ' 00:00:00';
					$args['enddate']   = \dash\validate::date($end_month) . ' 23:59:59';

					$result = \lib\db\products\report\get::sale_in_date($args);
				}
				break;

			default:
				// code...
				break;
		}


		return $result;

	}
}
?>