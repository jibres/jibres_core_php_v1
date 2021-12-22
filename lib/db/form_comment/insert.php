<?php
namespace lib\db\form_comment;


class insert
{
	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('form_comment', ...func_get_args());
	}

	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('form_comment', $_args);
	}



}
?>
