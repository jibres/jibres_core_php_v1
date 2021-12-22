<?php
namespace dash\db\tickets;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('tickets', $_args);
	}
}
?>