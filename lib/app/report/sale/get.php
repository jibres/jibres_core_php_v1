<?php
namespace lib\app\report\sale;


class get
{
	public static function master_report($_args = [])
	{
		$condition =
		[
			'startdate' => 'datetime',
			'enddate'   => 'datetime',
			'groupby'   => ['enum' => ['none', 'hour', 'date', 'week', 'month', 'year']],
			'daterange' => ['enum' => ['today','yesterday','last7days','last30days','last90days','lastmonth','lastyear','custom']],
			'starttime' => 'time',
			'endtime'   => 'time',




		];

		$require = [];
		$meta    = [];
		$data    = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['startdate'])
		{
			$data['startdate'] = date("Y-m-d H:i:s", strtotime("-1 year"));
		}

		if(!$data['enddate'])
		{
			$data['enddate'] = date("Y-m-d H:i:s");
		}

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
				while ($start <= $end);

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