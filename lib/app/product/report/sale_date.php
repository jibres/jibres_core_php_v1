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
			'type' => ['enum' => ['date', 'week', 'month', 'year', 'period']],
			'date' => 'date',
		];

		$require = ['type'];
		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$result = [];

		switch ($data['type'])
		{
			case 'date':
				$result = \lib\db\products\report\get::sale_in_date($data['date']);
				break;

			default:
				// code...
				break;
		}
		return $result;

	}
}
?>