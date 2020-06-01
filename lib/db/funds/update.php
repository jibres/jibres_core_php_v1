<?php
namespace lib\db\funds;


class update
{
	public static function record()
	{
		$result = \dash\db\config::public_update('funds', ...func_get_args());
		return $result;
	}
}
?>