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

}
?>