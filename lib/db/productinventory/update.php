<?php
namespace lib\db\productinventory;


class update
{
	public static function record()
	{
		$result = \dash\db\config::public_update('productinventory', ...func_get_args());
		return $result;
	}


}
?>