<?php
namespace dash\db\posts;


class insert
{


	public static function new_record()
	{
		return \dash\pdo\query_template::insert('posts', ...func_get_args());
	}



}
?>
