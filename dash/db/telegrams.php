<?php
namespace dash\db;

/**
 * This class describes an pagination.
 *
 * @author Reza
 *
 * All functions in this class became query bind PDO
 * @date 2021-12-31 18:20:04
 *
 */
class telegrams
{
	public static function insert($_args)
	{
		$_args = \dash\safe::safe($_args, 'raw-nottrim');
		return \dash\pdo\query_template::insert('telegrams', $_args);
	}


	public static function multi_insert($_args)
	{
		$_args = \dash\safe::safe($_args, 'raw-nottrim');
		return \dash\pdo\query_template::multi_insert('telegrams', $_args);
	}


	public static function update($_args, $_id)
	{
		$_args = \dash\safe::safe($_args, 'raw-nottrim');
		return \dash\pdo\query_template::update('telegrams', $_args, $_id);
	}


	public static function get($_id)
	{
		return \dash\pdo\query_template::get('telegrams', $_id);
	}



}
?>
