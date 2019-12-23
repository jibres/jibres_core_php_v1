<?php
namespace lib\db\factordetails;

class insert
{
	public static function multi_insert()
	{
		return \dash\db\config::public_multi_insert('factordetails', ...func_get_args());
	}
}
?>
