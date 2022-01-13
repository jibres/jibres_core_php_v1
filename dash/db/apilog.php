<?php
namespace dash\db;


/**
 * This class describes an address.
 *
 * @author Reza
 *
 * All functions in this class became query bind PDO
 * @date 2021-12-19 16:32:22
 *
 */
class apilog
{
	public static function remove_last_month()
	{
		$delete_query = "TRUNCATE apilog";
		\dash\pdo::query($delete_query, [], 'api_log');
		return 0;

		// $param = [];
		// $last_month      = date("Y-m-d", strtotime("-30 days"));
		// $param[':month'] = $last_month;

		// $delete_query = "SELECT apilog.id FROM apilog WHERE DATE(apilog.datesend) > DATE('$last_month') LIMIT 1";
		// $id = \dash\pdo::get($delete_query, $param, 'id', true, 'api_log');

		// if($id)
		// {
		// 	$delete_query = "DELETE FROM apilog WHERE apilog.id <= :id ";
		// 	$param['id'] = $id;
		// 	\dash\pdo::query($delete_query, $param, 'api_log');
		// }
		// return 0;
	}

	public static function insert($_args)
	{
		return \dash\pdo\query_template::insert('apilog', $_args, 'api_log');
	}


	public static function get_count()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM apilog ";
		$result = \dash\pdo::get($query, [], 'count', true, 'api_log');
		return $result;
	}


	public static function get($_id)
	{
		return \dash\pdo\query_template::get('apilog', $_id, 'api_log');
	}


	public static function search($_string = null, $_args = [])
	{
		return \dash\pdo\query_template::list_pagenation('apilog', 'api_log');
	}

}
?>
