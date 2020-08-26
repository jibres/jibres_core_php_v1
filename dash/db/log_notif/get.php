<?php
namespace dash\db\log_notif;


class get
{


	/**
	 * Insert new record to product category table
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function group_by()
	{

		$query = " SELECT COUNT(*) AS `count`, log_notif.messagemd5, MAX(log_notif.message) AS `message` FROM log_notif GROUP BY log_notif.messagemd5 ORDER BY count(*) DESC";
		$result = \dash\db::get($query);
		return $result;
	}

}
?>
