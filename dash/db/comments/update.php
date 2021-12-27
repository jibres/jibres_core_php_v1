<?php
namespace dash\db\comments;


class update
{

	public static function update($_args, $_id)
	{
		$_args['datemodified'] = date("Y-m-d H:i:s");

		return \dash\pdo\query_template::update('comments', $_args, $_id);

	}
}
?>