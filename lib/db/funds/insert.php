<?php
namespace lib\db\funds;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('funds', $_args);

	}
}
?>