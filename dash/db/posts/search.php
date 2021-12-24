<?php
namespace dash\db\posts;

class search
{
	public static function list($_and, $_or, $_order_sort = null, $_meta = [])
	{
		$q = \dash\pdo\prepare_query::ready_to_sql($_and, $_or, $_order_sort, $_meta);

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
			$pagination_query = "SELECT COUNT(*) AS `count` FROM posts $q[join] $q[where]  ";
			$limit = \dash\db\pagination::pagination_query($pagination_query, $q['limit']);
		}


		$query = "SELECT $q[fields] FROM posts $q[join] $q[where] $q[order] $limit ";
		$result = \dash\pdo::get($query);

		return $result;
	}


	public static function random_help_center($_lang)
	{
		$query  = "SELECT * FROM posts WHERE posts.type = 'help' AND posts.status = 'publish' AND posts.language = '$_lang' ORDER BY RAND() LIMIT 5 ";
		$result = \dash\pdo::get($query);
		return $result;
	}


}
?>