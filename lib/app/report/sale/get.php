<?php
namespace lib\app\report\sale;


class get
{
	public static function date_range()
	{
		return
		[
			'today'      =>  T_("Today"),
			'yesterday'  =>  T_("Yesterday"),
			'last7days'  =>  T_("Last 7 days"),
			'last30days' =>  T_("Last 30 days"),
			'last90days' =>  T_("Last 90 days"),
			'lastmonth'  =>  T_("Last month"),
			'lastyear'   =>  T_("Last year"),
			'custom'     =>  T_("Custom"),
			// 'Week to date'       =>  T_("Week to date"),
			// 'Month to date'      =>  T_("Month to date"),
			// 'Quarter to date'    =>  T_("Quarter to date"),
			// 'Year to date'       =>  T_("Year to date"),
			// '3rd Quarter (2021)' =>  T_("3rd Quarter (2021)"),
			// '2nd Quarter (2021)' =>  T_("2nd Quarter (2021)"),
			// '1st Quarter (2021)' =>  T_("1st Quarter (2021)"),
			// '4th Quarter (2020)' =>  T_("4th Quarter (2020)"),
		];

	}


	public static function group_by()
	{
		return
		[
			'none'  =>  T_("None"),
			'date'  =>  T_("Date"),
			'hour'  =>  T_("Hour"),
			'week'  =>  T_("Week"),
			'month' =>  T_("Month"),
			'year'  =>  T_("Year"),
		];
	}


	public static function master_report($_args = [])
	{
		$condition =
		[
			'startdate' => 'date',
			'enddate'   => 'date',
			'groupby'   => ['enum' => array_keys(self::group_by())],
			'daterange' => ['enum' => array_keys(self::date_range())],
			'starttime' => 'time',
			'endtime'   => 'time',
		];



		$require = [];
		$meta    = [];
		$data    = \dash\cleanse::input($_args, $condition, $require, $meta);

		switch ($data['daterange'])
		{
			case 'today':
				$data['startdate'] = date("Y-m-d");
				$data['starttime'] = '00:00:00';
				$data['enddate']   = date("Y-m-d");
				$data['endtime']   = '23:59:59';
				break;

			case 'yesterday':
				$data['startdate'] = date("Y-m-d", strtotime("-1 days"));
				$data['starttime'] = '00:00:00';
				$data['enddate']   = date("Y-m-d", strtotime("-1 days"));
				$data['endtime']   = '23:59:59';
				break;

			case 'last7days':
				$data['startdate'] = date("Y-m-d", strtotime("-6 days"));
				$data['enddate']   = date("Y-m-d");
				break;

			case 'last30days':
				$data['startdate'] = date("Y-m-d", strtotime("-30 days"));
				$data['enddate']   = date("Y-m-d");
				break;

			case 'last90days':
				$data['startdate'] = date("Y-m-d", strtotime("-90 days"));
				$data['enddate']   = date("Y-m-d");
				break;

			case 'lastmonth':
				$data['startdate'] = date("Y-m-d", strtotime("-1 month"));
				$data['enddate']   = date("Y-m-d");
				break;

			case 'lastyear':
				$data['startdate'] = date("Y-m-d", strtotime("-1 year"));
				$data['enddate'] = date("Y-m-d");
				break;


			case 'custom':
			default:
				// nothing
				break;
		}

		if(!$data['startdate'])
		{
			$data['startdate'] = date("Y-m-d", strtotime("-1 year"));
		}

		if(!$data['enddate'])
		{
			$data['enddate'] = date("Y-m-d");
		}

		if(!$data['starttime'])
		{
			$data['starttime'] = date("H:i:s");
		}

		if(!$data['endtime'])
		{
			$data['endtime'] = date("H:i:s");
		}

		$data['startdate'] = $data['startdate']. ' '. $data['starttime'];
		$data['enddate']   = $data['enddate']. ' '. $data['endtime'];

		if(strtotime($data['startdate']) > strtotime($data['enddate']))
		{
			\dash\notif::error(T_("Start date must be less than end date"));
			return false;
		}

		if(!$data['groupby'])
		{
			$data['groupby'] = 'date';
		}

		$ready_chart_category = self::ready_chart_category($data);

		// invalid date or maximum capacity
		if(!$ready_chart_category)
		{
			return false;
		}

		$raw_result = \lib\db\factors\report::sale_report($data);

		if(!is_array($raw_result))
		{
			$raw_result = [];
		}

		$categories = [];
		$chartvalue = [];

		foreach ($raw_result as $key => $value)
		{
			if(isset($ready_chart_category[a($value, 'groupbykey')]))
			{
				$ready_chart_category[$value['groupbykey']] = $value;
			}
		}

		foreach ($ready_chart_category as $key => $value)
		{
			$chartvalue[] = floatval(a($value, 'total'));
			$categories[] = \dash\fit::date(a($value, 'groupbykey'));
		}

		$chart = [];
		$chart['categories'] = json_encode($categories);
		$chart['chartvalue'] = json_encode($chartvalue);

		$result          = [];
		$result['raw']   = $ready_chart_category;
		$result['chart'] = $chart;
		$result['date']  =
		[
			'startdate' => \dash\fit::date_en(date("Y-m-d", strtotime($data['startdate']))),
			'enddate'   => \dash\fit::date_en(date("Y-m-d", strtotime($data['enddate']))),
			'starttime' => date("H:i", strtotime($data['startdate'])),
			'endtime'   => date("H:i", strtotime($data['enddate'])),
		];

		return $result;
	}


	/**
	 * Ready chart category
	 *
	 * @param      <type>  $_args  The arguments
	 */
	private static function ready_chart_category($_args)
	{
		$result  = [];
		$counter = 0;
		$start   = strtotime($_args['startdate']);
		$end     = strtotime($_args['enddate']);

		$default =
		[
			'count'       => 0,
			'qty'         => 0,
			'subprice'    => 0,
			'subtotal'    => 0,
			'subvat'      => 0,
			'subdiscount' => 0,
			'discount2'   => 0,
			'shipping'    => 0,
			'total'       => 0,
			'item'        => 0,
			'groupbykey' => null
  		];

		switch ($_args['groupby'])
		{
			case 'date':
				do
				{
					$myDate = date("Y-m-d", $start);
					$result[$myDate] = array_merge($default, ['groupbykey' => $myDate]);
					$start += (60*60*24);
					$counter++;

					if($counter >= 1000)
					{
						break;
					}
				}
				while ($start < $end);

				break;

			default:
				// code...
				break;
		}

		if($counter > 1000)
		{
			\dash\notif::error(T_("Only 1,000 record in result can be show"));
			return false;
		}


		return $result;
	}
}
?>