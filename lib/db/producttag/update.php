<?php
namespace lib\db\producttag;


class update
{
	public static function update($_args, $_id)
	{
		$set    = \dash\db\config::make_set($_args);
		$query  = "UPDATE producttag SET $set WHERE producttag.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

		public static function record()
	{
		$result = \dash\db\config::public_update('producttag', ...func_get_args());
		return $result;
	}
}
?>
