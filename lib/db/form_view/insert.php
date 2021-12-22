<?php
namespace lib\db\form_view;


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
		return \dash\pdo\query_template::insert('form_view', $_args);
	}


	public static function create_table($_table_name, $_files)
	{
		$fileds = [];
		foreach ($_files as $key => $value)
		{
			$fileds[] = "`$key` TEXT CHARSET utf8mb4 NULL DEFAULT NULL";
		}

		$fileds = implode(",", $fileds);

		$query  = " CREATE TABLE IF NOT EXISTS `$_table_name` (`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, $fileds, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
		$result = \dash\pdo::query($query, []);
		return $result;
	}

}
?>
