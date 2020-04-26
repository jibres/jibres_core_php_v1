<?php
namespace lib\pardakhtyar\db;

class request
{

	public static function insert($_args)
	{
		$set    = \dash\db\config::make_set($_args);
		$query  = "INSERT INTO pardakhtyar_request SET $set";
		$result = \dash\db::query($query);
		return \dash\db::insert_id();
	}

	public static function search($_string = null, $_option = [])
	{
		$default =
		[

		];


		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default, $_option);

		$result = \dash\db\config::public_search('pardakhtyar_request', $_string, $_option);
		return $result;
	}

}
?>
