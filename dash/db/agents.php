<?php
namespace dash\db;


class agents
{

	public static function insert($_args)
	{
		return \dash\db\config::public_insert('agents', $_args);
	}


	public static function get_count()
	{
		return \dash\db\config::public_get_full_count('agents');
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