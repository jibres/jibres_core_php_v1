<?php
namespace dash\db;

/**
 * This class describes an log.
 *
 * @author Reza
 *
 * All functions in this class became query bind PDO
 * @date 2021-12-30 15:37:07
 *
 */
class logs
{
	private static $logUpdate = [];


	public static function get_by_id($_id)
	{
		return \dash\pdo\query_template::get('logs', $_id);
	}


	public static function is_active_code($_caller, $_to)
	{
		$query = "SELECT * FROM logs WHERE logs.caller = :caller AND logs.to = :to AND logs.status IN ('enable', 'notif', 'notifread') LIMIT 1 ";
		$param =
		[
			':caller' => $_caller,
			':to'     => $_to,
		];

		return \dash\pdo::get($query, $param, null, true);
	}


	public static function notif_not_send()
	{
		$query = "SELECT * FROM logs WHERE logs.notif = 1 AND logs.send IS NULL ";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function count_caller_ip_date($_caller, $_start_date, $_end_date) : float
	{
		$ip     = \dash\server::iplong();

		$query  = "SELECT COUNT(*) AS `count` FROM logs WHERE logs.caller = :caller AND logs.ip = :ip AND DATE(logs.datecreated) >= DATE(:start_date) AND DATE(logs.datecreated) <= DATE(:end_date) ";

		$param =
		[
			':caller'     => $_caller,
			':ip'         => $ip,
			':start_date' => $_start_date,
			':end_date'   => $_end_date,
		];

		$result = \dash\pdo::get($query, $param, 'count', true);

		if(!is_numeric($result))
		{
			$result = 0;
		}

		return floatval($result);
	}


	public static function count_where_date($_where, $_date_time) : float
	{
		$q = \dash\pdo\prepare_query::generate_where('logs', $_where);

		$query  = "SELECT COUNT(*) AS `count` FROM logs WHERE $q[where] AND logs.datecreated >= :mydatetime ";

		$param = array_merge($q['param'], [':mydatetime' => $_date_time]);

		$result = \dash\pdo::get($query, $param, 'count', true);

		if(!is_numeric($result))
		{
			$result = 0;
		}

		return floatval($result);
	}



	public static function expire_notif()
	{
		$date_now = date("Y-m-d H:i:s");
		$query =
		"
			UPDATE
				logs
			SET
				logs.status   = 'notifexpire'
			WHERE
				logs.status != 'notifexpire' AND
				logs.notif  = 1 AND
				logs.expiredate < :datenow
		";

		$param =
		[
			':datenow' => $date_now,
		];

		$result = \dash\pdo::query($query, $param);
		return $result;
	}



	public static function get_chart_date()
	{
		$lastYear = date("Y-m-d", strtotime("-365 days"));
		$query = "SELECT count(*) AS `count`, DATE(logs.datecreated) AS `date` FROM logs WHERE DATE(logs.datecreated) > DATE(:lastyear) GROUP BY DATE(logs.datecreated) ";
		$param =
		[
			':lastyear' => $lastYear,
		];
		$result = \dash\pdo::get($query, $param, null, false);
		return $result;
	}



	public static function set_readdate_user($_user_id)
	{
		if(!$_user_id || !is_numeric($_user_id))
		{
			return false;
		}

		$query =
		"
			SELECT
				logs.id
			FROM
				logs
			WHERE
				logs.to = :user_id AND
				logs.status   = 'notif' AND
				logs.readdate = logs.readdate IS NULL
		";

		$param =
		[
			':user_id' => $_user_id,
		];

		$get_result = \dash\pdo::get($query, $param, 'id', false);
		if($get_result)
		{

			$id = implode(',', $get_result);
			$date_now = date("Y-m-d H:i:s");
			$query =
			"
				UPDATE
					logs
				SET
					logs.readdate = IF(logs.readdate IS NULL ,'$date_now', logs.readdate),
					logs.status   = 'notifread'
				WHERE
					logs.id IN ($id)
			";
			$result = \dash\pdo::query($query, []);
			return $result;
		}

	}


	public static function set_readdate($_ids)
	{
		$date_now = date("Y-m-d H:i:s");
		$query =
		"
			UPDATE
				logs
			SET
				logs.readdate = '$date_now',
				logs.status   = 'notifread'
			WHERE
				logs.id IN ($_ids) AND
				logs.readdate IS NULL
		";
		$result = \dash\pdo::query($query, []);
		return $result;
	}


	public static function my_notif_count($_user_id)
	{
		if(!$_user_id || !is_numeric($_user_id))
		{
			return false;
		}

		$query =
		"
			SELECT
				COUNT(*) AS `count`
			FROM
				logs
			WHERE
				logs.to     = :user_id AND
				logs.status = 'notif'
		";

		$param = [':user_id' => $_user_id];

		$result = \dash\pdo::get($query, $param, 'count', true);
		return $result;
	}


	public static function update_temp($_set, $_id)
	{
		self::$logUpdate[] = ['set' => $_set, 'id' => $_id];
	}


	public static function get_count($_where = null)
	{
		return \dash\pdo\query_template::get_count('logs', $_where);
	}


	public static function get_caller_group($_date = null)
	{
		$param = [];
		$date = null;
		if($_date)
		{
			$date = " WHERE logs.datecreated >= :fromdate ";
			$param[':fromdate'] = $_date;
		}

		$query = "SELECT count(*) AS `count`, logs.caller AS `caller` FROM logs $date GROUP BY logs.caller ORDER BY count(*) DESC";
		$result = \dash\pdo::get($query, $param, ['caller', 'count'], false);
		return $result;
	}


	public static function multi_insert($_args, $_fuel = null)
	{
		$result = \dash\pdo\query_template::multi_insert('logs', $_args, $_fuel);
		$result = \dash\pdo::insert_id();
		return $result;
	}



	public static function insert($_args, $_fuel = null)
	{
		return \dash\pdo\query_template::insert('logs', $_args, $_fuel);
	}



	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('logs', $_args, $_id);
	}


	public static function delete($_id)
	{
		// get id
		$query = "UPDATE FROM logs SET logs.notification_status = 'expire' WHERE logs.id = :id ";
		$param = [':id' => $_id];
		return \dash\pdo::query($query, $param);
	}


	/**
	 * { function_description }
	 *
	 * @param      <type>  $_user_id  The user identifier
	 * @param      <type>  $_caller   The caller
	 * @param      array   $_options  The options
	 */
	public static function set($_caller, $_user_id = null, $_options = [])
	{
		$default_options =
		[
			'visitor_id' => \dash\utility\visitor::id(),
			'status'     => 'enable',
			'data'       => null,
			'datalink'   => null,
			'meta'       => null,
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_options, $_options);

		if($_options['meta'])
		{
			$_options['meta'] = \dash\safe::safe($_options['meta']);

			if(is_array($_options['meta']) || is_object($_options['meta']))
			{
				$_options['meta'] = json_encode($_options['meta']);
			}
		}
		else
		{
			$_options['meta'] = null;
		}

		$user_id = null;

		if($_user_id && is_numeric($_user_id))
		{
			$user_id = $_user_id;
		}
		elseif(\dash\user::id())
		{
			$user_id = \dash\user::id();
		}

		if($_options['data'] && mb_strlen($_options['data']) >= 200)
		{
			$_options['data'] = substr($_options['data'], 0, 198);
		}

		if($_caller && mb_strlen($_caller) >= 200)
		{
			$_caller = substr($_caller, 0, 198);
		}

		$insert_log =
		[
			'caller'      => $_caller,
			'from'        => $user_id,
			'datecreated' => date("Y-m-d H:i:s"),
			'subdomain'   => \dash\url::subdomain() ? \dash\url::subdomain() : null,
			'visitor_id'  => $_options['visitor_id'],
			'data'        => $_options['data'],
			'status'      => $_options['status'],
			'meta'        => $_options['meta'],
		];

		return self::insert($insert_log);
	}


	public static function get_by_caller_code($_caller, $_code)
	{
		$query = "SELECT * FROM logs WHERE logs.caller = :caller AND logs.code = :code  ";
		$param =
		[
			':caller' => $_caller,
			':code'     => $_code,
		];

		return \dash\pdo::get($query, $param);
	}



	public static function get_caller_code_to_status($_caller, $_code, $_to, $_status)
	{
		$query = "SELECT * FROM logs WHERE logs.caller = :caller AND logs.code = :code AND logs.to = :to AND logs.status = :status  ";
		$param =
		[
			':caller' => $_caller,
			':code'   => $_code,
			':to'     => $_to,
			':status' => $_status,
		];

		return \dash\pdo::get($query, $param);
	}

}
?>
