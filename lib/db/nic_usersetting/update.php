<?php
namespace lib\db\nic_usersetting;


class update
{
	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('usersetting', $_args, $_id, 'nic');
	}

}
?>