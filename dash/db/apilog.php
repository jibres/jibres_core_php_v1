<?php
namespace dash\db;


class apilog
{

	public static function insert($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT IGNORE INTO `apilog` SET $set ";
			return \dash\db::query($query);
		}

	}


	public static function get_count()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM apilog ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function get($_where)
	{
		return \dash\db\config::public_get('apilog', $_where);
	}


	public static function search($_string = null, $_args = [])
	{
		$default =
		[

		];
		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default, $_args);

		$result = \dash\db\config::public_search('apilog', $_string, $_args);
		return $result;
	}

}
?>
