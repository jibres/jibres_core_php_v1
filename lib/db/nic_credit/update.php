<?php
namespace lib\db\nic_credit;


class update
{
	public static function record($_args, $_id)
	{
		return \dash\pdo\query_template::update('credit', $_args, $_id, 'nic');
	}


}
?>