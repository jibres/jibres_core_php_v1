<?php
namespace lib\db\store_features;


class update
{

	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('store_features', $_args, $_id);
	}


}
?>
