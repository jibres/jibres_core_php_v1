<?php
namespace lib\db\factors;


class update
{
	public static function record()
	{
		$result = \dash\db\config::public_update('factors', ...func_get_args());
		return $result;
	}
}
?>