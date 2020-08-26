<?php
namespace dash\db\log_notif;


class delete
{


	/**
	 * Insert new record to product category table
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function all()
	{
		$query = " TRUNCATE TABLE `log_notif` ";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>
