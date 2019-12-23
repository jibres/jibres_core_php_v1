<?php
namespace lib\db\producttagusage;


class insert
{
	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('producttagusage', ...func_get_args());
	}
}
?>
