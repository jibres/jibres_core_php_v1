<?php
namespace lib\db\productcategoryusage;


class insert
{
	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('productcategoryusage', ...func_get_args());
	}
}
?>
