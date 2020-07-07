<?php
namespace lib\db\irvat;


class update
{
	public static function record()
	{
		$result = \dash\db\config::public_update('ir_vat', ...func_get_args());
		return $result;
	}
}
?>