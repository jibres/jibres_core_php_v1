<?php
namespace lib\db\inventory;


class update
{
	public static function record()
	{
		$result = \dash\db\config::public_update('inventory', ...func_get_args());
		return $result;
	}


}
?>