<?php
namespace dash\db\log_notif;


class insert
{


	/**
	 * Insert new record to product category table
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function new_record($_args)
	{

		return \dash\pdo\query_template::insert('log_notif', $_args, ['ignore' => true]);


		// $set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		// if($set)
		// {
		// 	$query = " INSERT IGNORE INTO `log_notif` SET $set ";
		// 	if(\dash\db::query($query))
		// 	{
		// 		return true;
		// 	}
		// 	else
		// 	{
		// 		return false;
		// 	}
		// }
		// else
		// {
		// 	return false;
		// }
	}

}
?>
