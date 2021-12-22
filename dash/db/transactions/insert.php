<?php
namespace dash\db\transactions;


class insert
{

	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('transactions', $_args);
	}
}
?>