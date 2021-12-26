<?php
namespace dash\db;


class dayevent
{

	public static function multi_insert($_args)
	{
		return \dash\pdo\query_template::multi_insert('dayevent', $_args);
	}


	public static function get_all()
	{
		$query = "SELECT * FROM dayevent";
		$result = \dash\pdo::get($query, [], null, false);
		return $result;
	}


	public static function insert($_args)
	{
		return \dash\pdo\query_template::insert('dayevent', $_args, null, ['ignore' => true]);
	}


	public static function update($_args, $_id)
	{
		$set  = \dash\db\config::make_set($_args);
		if($set)
		{
			// make update query
			$query = "UPDATE dayevent SET $set WHERE dayevent.id = $_id LIMIT 1";
			return \dash\pdo::query($query, []);
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

}
?>
