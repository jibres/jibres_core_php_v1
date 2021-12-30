<?php
namespace dash\db;


/**
 * This class describes an ip.
 *
 * @author Reza
 *
 * All functions in this class became query bind PDO
 * @date 2021-12-27 15:47:41
 *
 */
class ip
{
	/**
	 * If jibres the fuel is visitor
	 * if in stroe current databse is fuel
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function ip_fuel()
	{
		if(\dash\engine\store::inStore())
		{
			return null;
		}
		else
		{
			return 'visitor';
		}
	}

	public static function get_by_id($_id)
	{
		$query  = "SELECT * FROM ip WHERE ip.id = :id LIMIT 1";
		$param = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, null, true, self::ip_fuel());
		return $result;
	}


	public static function get_ipv4($_ip)
	{
		$query  = "SELECT * FROM ip WHERE ip.ipv4 = :ip LIMIT 1";
		$param = [':ip' => $_ip];
		$result = \dash\pdo::get($query, $param, null, true, self::ip_fuel());
		return $result;
	}


	public static function get_ipv6($_ip)
	{
		$query  = "SELECT * FROM ip WHERE ip.ipv6 = :ip LIMIT 1";
		$param = [':ip' => $_ip];
		$result = \dash\pdo::get($query, $param, null, true, self::ip_fuel());
		return $result;
	}


	public static function count_modified_date($_date)
	{
		$query = "SELECT COUNT(*) AS `count` FROM ip WHERE DATE(ip.datemodified) = DATE(:mydate) ";
		$param = [':mydate' => $_date];
		$result = \dash\pdo::get($query, $param, 'count', true, self::ip_fuel());
		return $result;
	}


	public static function new_list()
	{
		$query  = "SELECT * FROM ip WHERE ip.block = 'new' LIMIT 1000";
		$param = [];
		$result = \dash\pdo::get($query, $param, null, false, self::ip_fuel());
		return $result;
	}


	public static function set_block($_id, $_count_block = null)
	{
		$query = "UPDATE ip SET ip.block = 'block', ip.countblock = :count_block WHERE ip.id = :id LIMIT 1";
		$param = [':id' => $_id, ':count_block' => $_count_block];
		$result = \dash\pdo::query($query, $param, self::ip_fuel());
		return $result;
	}


	public static function set_unblock($_id, $_count_block = null)
	{
		$query = "UPDATE ip SET ip.block = 'unblock', ip.countblock = :count_block WHERE ip.id = :id LIMIT 1";
		$param = [':id' => $_id, ':count_block' => $_count_block];
		$result = \dash\pdo::query($query, $param, self::ip_fuel());
		return $result;
	}


	public static function set_unknown($_id, $_count_block = null)
	{
		$query = "UPDATE ip SET ip.block = 'unknown', ip.countblock = :count_block WHERE ip.id = :id LIMIT 1";
		$param = [':id' => $_id, ':count_block' => $_count_block];
		$result = \dash\pdo::query($query, $param, self::ip_fuel());
		return $result;
	}



	public static function insert($_args)
	{
		return \dash\pdo\query_template::insert('ip', $_args, self::ip_fuel());
	}




	public static function list($_param, $_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\pdo\prepare_query::binded_ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM ip $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\pagination::pagination_query($pagination_query, $_param, $q['limit'], self::ip_fuel());
		}

		$query = "SELECT ip.* FROM ip $q[where] $q[order] $limit ";

		$result = \dash\pdo::get($query, $_param, null, false, self::ip_fuel());

		return $result;
	}



}
?>
