<?php
namespace lib\app\product\report;


class sale_date
{
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