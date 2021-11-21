<?php
namespace lib\db\social_posts;


class insert
{
	public static function new_record($_args)
	{
		return \dash\pdo\query_template::insert('social_posts', $_args);

	}
}
?>