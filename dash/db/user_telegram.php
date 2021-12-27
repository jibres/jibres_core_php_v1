<?php
namespace dash\db;


class user_telegram
{

	public static function get_dataTable($_ids)
	{
		$query  = "SELECT user_telegram.user_id, MAX(user_telegram.chatid) AS `chatid` FROM user_telegram WHERE user_telegram.user_id IN ($_ids)  GROUP BY user_telegram.user_id";
		$result = \dash\pdo::get($query);
		return $result;
	}


	public static function insert()
	{
		return \dash\pdo\query_template::insert('user_telegram', ...func_get_args());
	}


	public static function multi_insert()
	{
		return \dash\pdo\query_template::multi_insert('user_telegram', ...func_get_args());
	}


	public static function update()
	{
		return \dash\pdo\query_template::update('user_telegram', ...func_get_args());
	}


	public static function update_by_chat_id($_args, $_chat_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE user_telegram SET $set WHERE user_telegram.chatid = :chatid ";

		$param = [':chatid' => $_chat_id];

		$result = \dash\pdo::query($query, $param);

		return $result;
	}


	public static function get()
	{
		return \dash\db\config::public_get('user_telegram', ...func_get_args());
	}

	public static function get_count()
	{
		return \dash\pdo\query_template::get_count('user_telegram', ...func_get_args());
	}


	public static function hard_delete($_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			return false;
		}

		$query = "DELETE FROM user_telegram WHERE user_telegram.id = $_id LIMIT 1";
		return \dash\pdo::query($query, []);
	}
}
?>
