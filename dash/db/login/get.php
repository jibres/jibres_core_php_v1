<?php
namespace dash\db\login;


class get
{
	public static function load_code($_code)
	{
		$query = "SELECT * FROM login WHERE login.code = '$_code' LIMIT 1";
		$result = \dash\db::get($query, null, true, null, ['ignore_error' => true]);
		return $result;
	}

	public static function last_login($_user_id)
	{
		$query = "SELECT login.* FROM login WHERE login.user_id = $_user_id ORDER BY login.id DESC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function last_login_ip($_user_id)
	{
		$query =
		"
			SELECT
				login_ip.*
			FROM
				login_ip
			INNER JOIN login ON login.id = login_ip.login_id
			WHERE
				login.user_id = $_user_id
			ORDER BY login_ip.id DESC
			LIMIT 1
		";

		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function load_code_force_jibres($_code)
	{
		$query = "SELECT * FROM login WHERE login.code = '$_code' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master', ['ignore_error' => true]);
		return $result;
	}


	public static function get_active_sessions($_user_id)
	{
		$query =
		"
			SELECT
				login.*,
				agents.group AS `agent_group`,
				agents.agent AS `agent_agent`,
				agents.name AS `agent_name`,
				agents.version AS `agent_version`,
				agents.os AS `agent_os`,
				agents.osnum AS `agent_osnum`
			FROM
				login
			LEFT JOIN agents ON agents.id = login.agent_id
			WHERE
				login.user_id = $_user_id AND
				login.status = 'active'
			ORDER BY login.id DESC
			LIMIT 100
		";
		$result = \dash\db::get($query);
		return $result;
	}


	public static function get_count_all()
	{
		$query = "SELECT COUNT(*) AS `count` FROM login";
		$result = \dash\db::get($query, 'count', true);
		$result = floatval($result);
		return $result;
	}


	public static function get_count_all_on_ip($_ip)
	{
		$query =
		"
			SELECT
				COUNT(*) AS `count`
			FROM
				login_ip
			INNER JOIN login ON login.id = login_ip.login_id
			INNER JOIN users ON users.id = login.user_id
			WHERE
				(users.verifymobile IS NULL OR users.verifymobile = 0) AND
				login_ip.ip = '$_ip'
			GROUP By
				login_ip.ip
		";

		$result = \dash\db::get($query, 'count', true);
		return $result;

	}


	public static function get_count_all_group_by_ip()
	{
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				login_ip.ip
			FROM
				login_ip
			INNER JOIN login ON login.id = login_ip.login_id
			INNER JOIN users ON users.id = login.user_id
			WHERE
				(users.verifymobile IS NULL OR users.verifymobile = 0)
			GROUP By
				login_ip.ip
			HAVING COUNT(*) > 1
			ORDER BY COUNT(*) DESC
		";

		$result = \dash\db::get($query);
		return $result;

	}

}
?>