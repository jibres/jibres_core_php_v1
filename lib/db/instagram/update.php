<?php
namespace lib\db\instagram;

class update
{


	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('instagram', $_args, $_id);
	}




}
?>
