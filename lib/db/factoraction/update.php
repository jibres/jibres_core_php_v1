<?php
namespace lib\db\factoraction;


class update
{
	public static function record()
	{
		$result = \dash\db\config::public_update('factoraction', ...func_get_args());
		return $result;
	}
}
?>