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
		];

		$require = ['type'];

		if(a($_args, 'type') === 'period')
		{
			$require[] = 'startdate';
			$require[] = 'enddate';
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

			default:
				// code...
				break;
		}
		return $result;

	}
}
?>