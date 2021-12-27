<?php
namespace dash\db;

/**
 * This class describes agents.
 *
 * @author Reza
 *
 * All functions in this class became query bind PDO
 * @date 2021-12-27 14:41:07
 */
class agents
{

	public static function insert($_args)
	{
		return \dash\pdo\query_template::insert('agents', $_args);
	}


	public static function get_count()
	{
		return \dash\pdo\query_template::table_rows('agents');
	}


	public static function get_agent_detail($_md5)
	{
		$query  = "SELECT * FROM agents WHERE agents.agentmd5 = :md5 LIMIT 1";
		$param  = [':md5' => $_md5];
		$result = \dash\pdo::get($query, $param, null, true, null, ['ignore_error' => true]);
		return $result;
	}


}
?>