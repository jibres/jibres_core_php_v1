<?php
namespace lib\db\form_tag;


class update
{
	public static function update($_args, $_id)
	{
		$set    = \dash\db\config::make_set($_args);
		$query  = "UPDATE form_tag SET $set WHERE form_tag.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, []);
		return $result;
	}

		public static function record()
	{
		$result = \dash\pdo\query_template::update('form_tag', ...func_get_args());
		return $result;
	}
}
?>
