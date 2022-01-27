<?php
namespace dash\db;


class userdetail
{


	public static function insert()
	{
		\dash\pdo\query_template::insert('userdetail', ...func_get_args());
	}


	public static function insert_multi()
	{
		return \dash\pdo\query_template::multi_insert('userdetail', ...func_get_args());
	}


	public static function update()
	{
		return \dash\pdo\query_template::update('userdetail', ...func_get_args());
	}



	public static function get()
	{
		return \dash\pdo\query_template::get_where('userdetail', ...func_get_args());
	}


	public static function get_count()
	{
		return \dash\pdo\query_template::get_count('userdetail', ...func_get_args());
	}


	public static function list($_param, $_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\pdo\prepare_query::binded_ready_to_sql($_and, $_or, $_order_sort, $_meta);

		if($q['pagination'] === false)
		{
			if($q['limit'])
			{
				$limit = "LIMIT $q[limit] ";
			}
			else
			{
				$limit = "LIMIT 100 ";
			}
		}
		else
		{
			$pagination_query = "SELECT COUNT(*) AS `count` FROM userdetail $q[join] $q[where]  ";
			$limit = \dash\db\pagination::pagination_query($pagination_query, $_param, $q['limit']);
		}


		$query = "SELECT $q[fields] FROM userdetail $q[join] $q[where] $q[order] $limit ";
		$result = \dash\pdo::get($query, $_param);

		return $result;
	}




}
?>
