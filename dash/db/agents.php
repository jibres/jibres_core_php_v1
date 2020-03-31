<?php
namespace dash\db;

/** agents managing **/
class agents
{
	/**
	 * insert new agetn in database and return id of it
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function insert($_args)
	{
		$result = \dash\db\config::public_insert('agents', $_args);
		$result = \dash\db::insert_id();
		return $result;
	}


	/**
	 * get agent query
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function get($_where)
	{
		return \dash\db\config::public_get('agents', $_where);
	}


	public static function get_agent_detail($_md5)
	{
		$query = "SELECT * FROM agents WHERE agents.agentmd5 = '$_md5' LIMIT 1";
		$result = \dash\db::get($query, null, true, null, ['ignore_error' => true]);
		return $result;
	}


	public static function get_count($_where = [])
	{
		return \dash\db\config::public_get_count('agents', $_where);
	}
}
?>
