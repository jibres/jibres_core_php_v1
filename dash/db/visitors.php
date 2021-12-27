<?php
namespace dash\db;

/** visitors managing **/
class visitors
{
	public static $fields =	" * ";

	public static function get_count($_where = [])
	{
		return \dash\pdo\query_template::get_count('visitors', $_where);
	}


	public static function url_get_count($_where = [])
	{
		return \dash\pdo\query_template::get_count('urls', $_where);
	}

	public static function get_url_like($_url, $_where = [])
	{
		$where = null;
		if($_where)
		{
			$where = \dash\db\config::make_where($_where);
			if($where)
			{
				$where = " AND $where";
			}
		}

		$query =
		"
			SELECT
				visitors.*,
				urls.pwd,
				urls.subdomain,
				urls.domain,
				urls.path
			FROM
				visitors
			LEFT JOIN urls ON urls.id = visitors.url_id
			WHERE urls.pwd LIKE '$_url'
			$where
		";
		$result = \dash\pdo::get($query, [], null, false);
		return $result;
	}

	public static function visitor_page($_url, $_where = [])
	{
		$where = null;
		if($_where)
		{
			$where = \dash\db\config::make_where($_where);
			if($where)
			{
				$where = " AND $where";
			}
		}

		$query =
		"
			SELECT COUNT(myTable.count) AS `myCount`
			FROM
			(
				SELECT
					COUNT(*) AS `count`,
					IF(visitors.user_id IS NULL, visitors.session_id , visitors.user_id) AS `myUser`
				FROM visitors
				LEFT JOIN urls ON urls.id = visitors.url_id
				WHERE
					urls.pwd = '$_url'
					$where
				GROUP BY myUser
			) AS `myTable`
		";

		$result = \dash\pdo::get($query, [], 'myCount', true);

		return $result;

	}


	private static function calc_start_time($_args)
	{
		if(isset($_args['period']))
		{
			$period = null;
			switch ($_args['period'])
			{
				case 'week':
					$period = date("Y-m-d H:i:s", strtotime('-1 week'));
					break;

				case 'month':
					$period = date("Y-m-d H:i:s", strtotime('-1 month'));
					break;

				case 'hours24':
				default:
					$period = date("Y-m-d H:i:s", strtotime('-24 hours'));
					break;
			}
			return $period;
		}
		return false;
	}


	public static function total_visit($_args)
	{
		$start_time = self::calc_start_time($_args);
		if(!$start_time)
		{
			return null;
		}

		$query = "SELECT COUNT(*) AS `count` FROM visitors WHERE visitors.date >= '$start_time'";
		$result = \dash\pdo::get($query, [], 'count', true);
		return $result;
	}

	public static function total_visitor($_args)
	{
		$start_time = self::calc_start_time($_args);
		if(!$start_time)
		{
			return null;
		}

		$query =
		"
			SELECT COUNT(myTable.count) AS `myCount`
			FROM
			(
				SELECT
				COUNT(*) AS `count`,
				IF(visitors.user_id IS NULL, visitors.session_id , visitors.user_id) AS `myUser`
				FROM visitors
				WHERE
					visitors.date >= '$start_time'
				GROUP BY myUser
			) AS `myTable`
		";

		$result = \dash\pdo::get($query, [], 'myCount', true);

		return $result;
	}

	public static function total_avgtime($_args)
	{
		$start_time = self::calc_start_time($_args);
		if(!$start_time)
		{
			return null;
		}

		$query = "SELECT AVG(visitors.avgtime) AS `avg` FROM visitors WHERE visitors.avgtime IS NOT NULL AND visitors.date >= '$start_time' ";

		$result = \dash\pdo::get($query, [], 'avg', true);

		return $result;
	}


	public static function total_maxtrafictime($_args)
	{
		$start_time = self::calc_start_time($_args);
		if(!$start_time)
		{
			return null;
		}

		$query =
		"
			SELECT DATE(visitors.date) AS `date`, HOUR(visitors.date) AS `hour`
			FROM  visitors
			WHERE visitors.date >= '$start_time'
			GROUP BY DATE(visitors.date), HOUR(visitors.date)
			ORDER BY COUNT(*) DESC
			LIMIT 1
		";

		$result = \dash\pdo::get($query, [], null, true);
		if(isset($result['date']) && isset($result['hour']))
		{
			return $result['date']. ' '. $result['hour'];
		}
		return null;
	}


	public static function chart_visitorchart($_args)
	{
		$start_time = self::calc_start_time($_args);
		if(!$start_time)
		{
			return null;
		}

		if(!isset($_args['period']))
		{
			return false;
		}

		$subdomain = null;
		$join_url = null;
		if(isset($_args['subdomain']) && $_args['subdomain'])
		{
			$subdomain = " AND urls.subdomain = '$_args[subdomain]' ";
			$join_url = " LEFT JOIN urls ON urls.id = visitors.url_id ";
		}

		$diff_query = "HOUR(visitors.date) AS `myDate`,";
		switch ($_args['period'])
		{
			case 'week':
				$diff_query = "DATE(visitors.date) AS `myDate`,";
				break;

			case 'month':
				$diff_query = "DATE(visitors.date) AS `myDate`,";
				break;

			case 'hours24':
			default:
				$diff_query = "HOUR(visitors.date) AS `myDate`,";
				break;
		}

		$query =
		"
			SELECT COUNT(myTable.count) AS `myCount`, myTable.myDate
			FROM
				(
					SELECT
					$diff_query
					COUNT(DISTINCT visitors.id) AS `count`,
					IF(visitors.user_id IS NULL, visitors.session_id , visitors.user_id) AS `myUser`
					FROM visitors
					$join_url
					WHERE
						visitors.date >= '$start_time'
						$subdomain
					GROUP BY myDate, myUser
				) AS `myTable`
			GROUP BY myTable.myDate
		";

		$result_visitor = \dash\pdo::get($query, [], ['myDate', 'myCount'], false);


		$query =
		"
			SELECT
			$diff_query
			COUNT(DISTINCT visitors.id) AS `count`
			FROM visitors
			$join_url
			WHERE
				visitors.date >= '$start_time'
				$subdomain
			GROUP BY myDate
		";

		$result_visit = \dash\pdo::get($query, [], ['myDate', 'count'], false);

		return ['visitor' => $result_visitor, 'visit' => $result_visit];

	}

	public static function chart_country($_args)
	{
		$start_time = self::calc_start_time($_args);
		if(!$start_time)
		{
			return false;
		}
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				visitors.country AS `country`
			FROM
				visitors
			WHERE
				visitors.date >= '$start_time'
			GROUP BY visitors.country
		";
		$result = \dash\pdo::get($query, [], ['country', 'count'], false);
		return $result;

	}


	public static function chart_browser($_args)
	{
		$start_time = self::calc_start_time($_args);
		if(!$start_time)
		{
			return false;
		}
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				agents.name AS `name`
			FROM
				visitors
			LEFT JOIN agents ON agents.id = visitors.agent_id
			WHERE
				visitors.date >= '$start_time'
			GROUP BY agents.name
		";
		$result = \dash\pdo::get($query, [], ['name', 'count'], false);

		return $result;
	}


	public static function chart_os($_args)
	{
		$start_time = self::calc_start_time($_args);
		if(!$start_time)
		{
			return false;
		}
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				agents.os AS `os`
			FROM
				visitors
			LEFT JOIN agents ON agents.id = visitors.agent_id
			WHERE
				visitors.date >= '$start_time'
			GROUP BY agents.os
		";
		$result = \dash\pdo::get($query, [], ['os', 'count'], false);
		return $result;
	}







}
?>
