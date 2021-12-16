<?php
namespace lib\db\orders;

class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('factors', $_args);
	}
}
?>