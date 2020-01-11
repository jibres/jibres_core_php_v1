<?php
namespace lib\db\productcomment;


class insert
{

	public static function new_record()
	{
		\dash\db\config::public_insert('productcomment', ...func_get_args());
		return \dash\db::insert_id();
	}

}
?>
