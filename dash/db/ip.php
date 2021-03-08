<?php
namespace dash\db;


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


	public static function get_ipv4($_ip)
	{
		$query  = "SELECT * FROM ip WHERE ip.ipv4 = '$_ip' LIMIT 1";
		$result = \dash\db::get($query, null, true, self::ip_fuel());
		return $result;
	}


	public static function get_ipv6($_ip)
	{
		$query  = "SELECT * FROM ip WHERE ip.ipv6 = '$_ip' LIMIT 1";
		$result = \dash\db::get($query, null, true, self::ip_fuel());
		return $result;
	}


	public static function count_modified_date($_date)
	{
		$query = "SELECT COUNT(*) AS `count` FROM ip WHERE DATE(ip.datemodified) = DATE('$_date') ";
		$result = \dash\db::get($query, 'count', true, self::ip_fuel());
		return $result;
	}


	public static function new_list()
	{
		$query  = "SELECT * FROM ip WHERE ip.block = 'new' LIMIT 1000";
		$result = \dash\db::get($query, null, false, self::ip_fuel());
		return $result;
	}


	public static function set_block($_id, $_count_block = null)
	{
		$query = "UPDATE ip SET ip.block = 'block', ip.countblock = $_count_block WHERE ip.id = $_id LIMIT 1";
		$result = \dash\db::query($query, self::ip_fuel());
		return $result;
	}


	public static function set_unblock($_id, $_count_block = null)
	{
		$query = "UPDATE ip SET ip.block = 'unblock', ip.countblock = $_count_block WHERE ip.id = $_id LIMIT 1";
		$result = \dash\db::query($query, self::ip_fuel());
		return $result;
	}


	public static function set_unknown($_id, $_count_block = null)
	{
		$query = "UPDATE ip SET ip.block = 'unknown', ip.countblock = $_count_block WHERE ip.id = $_id LIMIT 1";
		$result = \dash\db::query($query, self::ip_fuel());
		return $result;
	}



	public static function insert($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `ip` SET $set ";
			if(\dash\db::query($query, self::ip_fuel()))
			{
				return \dash\db::insert_id();
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}




	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = \dash\db\config::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM ip $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit'], self::ip_fuel());
		}

		$query = "SELECT ip.* FROM ip $q[where] $q[order] $limit ";

		$result = \dash\db::get($query, null, false, self::ip_fuel());

		return $result;
	}



}
?>
