<?php
namespace lib\db\nic_contactdetail;


class update
{
	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('contactdetail', $_args, $_id, 'nic');
	}


}
?>
