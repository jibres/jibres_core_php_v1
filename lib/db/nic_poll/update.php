<?php
namespace lib\db\nic_poll;


class update
{
	public static function update($_args, $_poll_id)
	{
		return \dash\pdo\query_template::update('poll', $_args, $_id, 'nic');
	}
}
?>