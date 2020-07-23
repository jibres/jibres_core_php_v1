<?php
namespace lib\db\factordetails;


class update
{
	public static function record()
	{
		$result = \dash\db\config::public_update('factordetails', ...func_get_args());
		return $result;
	}
}
?>