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


		$result = [];

		switch ($data['type'])
		{
			case 'date':
				$args['startdate'] = $data['date'] . ' 00:00:00';
				$args['enddate']   = $data['date'] . ' 23:59:59';
				$result = \lib\db\products\report\get::sale_in_date($args);
				break;

			case 'period':
				if($data['startdate'] && $data['enddate'])
				{
					$args['startdate'] = $data['startdate'] . ' 00:00:00';
					$args['enddate']   = $data['enddate'] . ' 23:59:59';
					$result = \lib\db\products\report\get::sale_in_date($args);
				}
				break;

			case 'year':
				if($data['year'])
				{
					$end_of_year = 29;

					if( (intval($data['year']) % 4) == 3)
					{
						$end_of_year = 30;
					}

					$start_year = $data['year']. '-01-01 00:00:00';
					$end_year   = $data['year']. "-12-$end_of_year 23:59:59";

					$args['startdate'] = \dash\validate::date($start_year) . ' 00:00:00';
					$args['enddate']   = \dash\validate::date($end_year) . ' 23:59:59';

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