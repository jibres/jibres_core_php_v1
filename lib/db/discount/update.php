<?php
namespace lib\db\discount;


class update
{

	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('discount', $_args, $_id);
	}

}
?>
