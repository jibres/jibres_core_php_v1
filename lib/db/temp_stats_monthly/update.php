<?php
namespace lib\db\temp_stats_monthly;


class update
{

	/**
	 * Insert new record to product category table
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function record($_set, $_id)
	{
		$set = \dash\db\config::make_set($_set);

		$query  = "UPDATE temp_stats_monthly SET $set WHERE  temp_stats_monthly.id = $_id LIMIT 1";

		$result = \dash\db::query($query, 'master');

		return $result;
	}

}
?>
