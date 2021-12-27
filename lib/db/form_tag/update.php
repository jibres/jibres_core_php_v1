<?php
namespace lib\db\form_tag;


class update
{
	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('form_tag', $_args, $_id);
	}

		public static function record()
	{
		$result = \dash\pdo\query_template::update('form_tag', ...func_get_args());
		return $result;
	}
}
?>
