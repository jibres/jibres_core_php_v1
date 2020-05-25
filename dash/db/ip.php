<?php
namespace dash\db;


class ip
{

	public static function get_ipv4($_ip)
	{
		$query  = "SELECT * FROM ip WHERE ip.ipv4 = '$_ip' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'visitor');
		return $result;
	}


	public static function get_ipv6($_ip)
	{
		$query  = "SELECT * FROM ip WHERE ip.ipv6 = '$_ip' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'visitor');
		return $result;
	}


	public static function count_modified_date($_date)
	{
		$query = "SELECT COUNT(*) AS `count` FROM ip WHERE DATE(ip.datemodified) = DATE('$_date') ";
		$result = \dash\db::get($query, 'count', true, 'visitor');
		return $result;
	}


	public static function new_list()
	{
		$query  = "SELECT * FROM ip WHERE ip.block = 'new' LIMIT 1000";
		$result = \dash\db::get($query, null, false, 'visitor');
		return $result;
	}


	public static function set_block($_id, $_count_block = null)
	{
		$query = "UPDATE ip SET ip.block = 'block', ip.countblock = $_count_block WHERE ip.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'visitor');
		return $result;
	}


	public static function set_unblock($_id, $_count_block = null)
	{
		$query = "UPDATE ip SET ip.block = 'unblock', ip.countblock = $_count_block WHERE ip.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'visitor');
		return $result;
	}


	public static function set_unknown($_id, $_count_block = null)
	{
		$query = "UPDATE ip SET ip.block = 'unknown', ip.countblock = $_count_block WHERE ip.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'visitor');
		return $result;
	}



	public static function insert($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `ip` SET $set ";
			if(\dash\db::query($query, 'visitor'))
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

	private static function ready_to_sql($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$where = null;
		$q     = [];

		if($_and)
		{
			$_and = implode(' AND ', $_and);
			$q[] = "$_and";

		}

		if($_or)
		{
			$_or = implode(' OR ', $_or);
			$q[] = "($_or)";
		}

		if($q)
		{
			$where = 'WHERE '. implode(" AND ", $q);
		}

		$order = null;
		if($_order_sort && is_string($_order_sort))
		{
			$order = $_order_sort;
		}

		$pagination = null;
		if(array_key_exists('pagination', $_meta))
		{
			$pagination = $_meta['pagination'];
		}

		$limit = null;
		if(array_key_exists('limit', $_meta))
		{
			$limit = $_meta['limit'];
		}

		return
		[
			'where'      => $where,
			'order'      => $order,
			'pagination' => $pagination,
			'limit'      => $limit,
		];
	}





	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{

		$q = self::ready_to_sql($_and, $_or, $_order_sort, $_meta);

		$pagination_query = "SELECT COUNT(*) AS `count` FROM ip $q[where] ";

		$limit = null;
		if($q['pagination'] !== false)
		{
			$limit = \dash\db\mysql\tools\pagination::pagination_query($pagination_query, $q['limit'], 'visitor');
		}

		$query = "SELECT ip.* FROM ip $q[where] $q[order] $limit ";

		$result = \dash\db::get($query, null, false, 'visitor');

		return $result;
	}



}
?>
