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
	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('temp_stats_monthly', $_args, $_id);

	}

}
?>
