<?php
namespace lib\db\temp_stats_monthly;


class get
{


	/**
	 * Insert new record to product category table
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function check_exists($_year, $_month)
	{
		$query = "SELECT * FROM temp_stats_monthly WHERE temp_stats_monthly.year = :year AND temp_stats_monthly.month = :month LIMIT 1 ";
		$param =
		[
			':year' => intval($_year),
			':month' => intval($_month),
		];

		$result = \dash\pdo::get($query, $param, null, true, 'master');

		return $result;
	}


	public static function all()
	{
		$query = "SELECT * FROM temp_stats_monthly WHERE 1 ORDER BY temp_stats_monthly.year ASC, temp_stats_monthly.month ASC ";

		$result = \dash\pdo::get($query);

		return $result;

	}

}
?>
