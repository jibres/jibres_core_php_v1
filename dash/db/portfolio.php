<?php
namespace dash\db;

/**
 * This class describes an portfolio.
 *
 * @author Reza
 *
 * All functions in this class became query bind PDO
 * @date 2021-12-27 15:00:05
 *
 */
class portfolio
{

	public static function list_portfolio_tags()
	{
		$query  = "SELECT portfolio.tag1, portfolio.tag2, portfolio.tag3, portfolio.tag4, portfolio.tag5 FROM portfolio ";
		$result = \dash\pdo::get($query);
		return $result;
	}

	public static function get_by_id($_id)
	{
		$query  = "SELECT * FROM portfolio WHERE portfolio.id = :id LIMIT 1";
		$param  = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}


	public static function insert($_args)
	{
		return \dash\pdo\query_template::insert('portfolio', $_args);
	}



	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('portfolio', $_args, $_id);
	}


	public static function delete($_id)
	{
		$query  = "DELETE FROM portfolio WHERE portfolio.id = :id LIMIT 1";
		$param  = [':id' => $_id];
		$result = \dash\pdo::query($query, $param);
		return $result;
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
			$pagination_query = "SELECT COUNT(*) AS `count` FROM portfolio $q[join] $q[where]  ";
			$limit = \dash\db\pagination::pagination_query($pagination_query, $_param, $q['limit']);
		}

		$query = " SELECT portfolio.* FROM portfolio $q[join] $q[where] $q[order] $limit ";
		$result = \dash\pdo::get($query, $_param);

		return $result;
	}

}
?>
