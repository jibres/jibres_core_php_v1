<?php
namespace lib\db\form_tag;


class update
{
	public static function update($_args, $_id)
	{
		$set    = \dash\db\config::make_set($_args);
		$query  = "UPDATE form_tag SET $set WHERE form_tag.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

		public static function record()
	{
		$result = \dash\db\config::public_update('form_tag', ...func_get_args());
		return $result;
	}
}
?>
