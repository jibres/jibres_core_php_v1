<?php
namespace dash\db;


class dayevent
{

	public static function multi_insert($_args)
	{
		return \dash\db\config::public_multi_insert('dayevent', $_args);
	}


	public static function get_all()
	{
		$query = "SELECT * FROM dayevent";
		$result = \dash\db::get($query, null, false);
		return $result;
	}


	public static function insert($_args)
	{

		$set = \dash\db\config::make_set($_args);
		if($set)
		{
			$query  ="INSERT IGNORE INTO dayevent SET $set ";

			$result = \dash\db::query($query);
			$result = \dash\db::insert_id();
			return $result;
		}
	}


	public static function update($_args, $_id)
	{
		$set  = \dash\db\config::make_set($_args);
		if($set)
		{
			// make update query
			$query = "UPDATE dayevent SET $set WHERE dayevent.id = $_id LIMIT 1";
			return \dash\db::query($query);
		}
	}


	public static function get($_args, $_options = [])
	{
		$default =
		[

		];

		$_options = array_merge($default, $_options);

		return \dash\db\config::public_get('dayevent', $_args, $_options);
	}


	public static function search($_string = null, $_options = [])
	{
		$default =
		[

		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default, $_options);
		$result   = \dash\db\config::public_search('dayevent', $_string, $_options);

		return $result;
	}
}
?>
