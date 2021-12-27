<?php
namespace lib\db\gift;


class update
{
	public static function update($_args, $_id)
	{
		$_args['datemodified'] = date("Y-m-d H:i:s");

		return \dash\pdo\query_template::update('gift', $_args, $_id);

	}
}
?>