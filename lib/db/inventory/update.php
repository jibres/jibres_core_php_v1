<?php
namespace lib\db\inventory;


class update
{
	public static function record()
	{
		$result = \dash\db\config::public_update('inventory', ...func_get_args());
		return $result;
	}


	public static function gallery($_gallery, $_id)
	{
		$query  = "UPDATE inventory SET inventory.file = '$_gallery' WHERE inventory.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>