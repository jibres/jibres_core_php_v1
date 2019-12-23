<?php
namespace lib\db\producttag;


class insert
{
	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('producttag', ...func_get_args());
	}
}
?>
