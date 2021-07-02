<?php
namespace lib\db\sitebuilder;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('pagebuilder', $_args);
	}
}
?>