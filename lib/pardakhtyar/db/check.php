<?php
namespace lib\pardakhtyar\db;

/** pardakhtyar_check managing **/
class check
{

	public static function get_by_id($_id)
	{
		$query = "SELECT * FROM `pardakhtyar_check` WHERE pardakhtyar_check.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;

	}
	public static function insert($_args)
	{
		$_args = \dash\safe::safe($_args, 'raw-nottrim');
		return \dash\db\config::public_insert('`pardakhtyar_check`', $_args);
	}


	public static function multi_insert($_args)
	{
		$_args = \dash\safe::safe($_args, 'raw-nottrim');
		return \dash\db\config::public_multi_insert('pardakhtyar_check', $_args);
	}


	public static function update($_args, $_id)
	{
		$_args = \dash\safe::safe($_args, 'raw-nottrim');
		return \dash\db\config::public_update('pardakhtyar_check', $_args, $_id);
	}


	public static function get($_where, $_option = [])
	{
		return \dash\db\config::public_get('pardakhtyar_check', $_where);
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

		$result = \dash\db\config::public_search('pardakhtyar_check', $_string, $_option);
		return $result;
	}

}
?>
