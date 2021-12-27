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
		return \dash\pdo\query_template::update('dayevent', $_args, $_id);
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
