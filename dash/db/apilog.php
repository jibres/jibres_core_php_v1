<?php
namespace dash\db;


class apilog
{
	public static function remove_last_month()
	{
		$last_month  = date("Y-m-d", strtotime("-30 days"));
		$count_query = "SELECT COUNT(*) AS `count` FROM apilog WHERE DATE(apilog.datesend) <= DATE('$last_month') ";
		$count       = floatval(\dash\pdo::get($count_query, [], 'count', true, 'api_log'));

		$delete_query = "DELETE FROM apilog WHERE DATE(apilog.datesend) <= DATE('$last_month') ";
		\dash\pdo::query($delete_query, [], 'api_log');

		return $count;
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
