<?php
namespace dash\db;

/**
 * This class describes an dayevent.
 *
 * @author Reza
 *
 * All functions in this class became query bind PDO
 * @date 2021-12-27 15:02:05
 *
 */
class dayevent
{

	public static function multi_insert($_args)
	{
		return \dash\pdo\query_template::multi_insert('dayevent', $_args);
	}


	public static function get_all()
	{
		$query = "SELECT * FROM dayevent";
		$result = \dash\pdo::get($query, [], null, false);
		return $result;
	}


	public static function insert($_args)
	{
		return \dash\pdo\query_template::insert('dayevent', $_args, null, ['ignore' => true]);
	}


	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('dayevent', $_args, $_id);
	}


	public static function get_by_date($_date)
	{
		$query = "SELECT * FROM dayevent WHERE dayevent.date = :mydate LIMIT 1 ";

		$param = [':mydate' => $_date];

		$result = \dash\pdo::get($query, $param, null, true);

		return $result;
	}

}
?>
