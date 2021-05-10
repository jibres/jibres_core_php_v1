<?php
namespace lib\db\temp_stats_monthly;


class delete
{


	/**
	 * Insert new record to product category table
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function delete_all()
	{
		$query = "DELETE  FROM temp_stats_monthly WHERE 1";

		$result = \dash\pdo::query($query, [], 'master');

		return $result;
	}

}
?>
