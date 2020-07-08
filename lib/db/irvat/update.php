<?php
namespace lib\db\irvat;


class update
{
	public static function record()
	{
		$result = \dash\db\config::public_update('ir_vat', ...func_get_args());
		return $result;
	}


	public static function gallery($_gallery, $_id)
	{
		$query  = "UPDATE ir_vat SET ir_vat.file = '$_gallery' WHERE ir_vat.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>