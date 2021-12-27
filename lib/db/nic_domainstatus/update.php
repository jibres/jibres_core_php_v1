<?php
namespace lib\db\nic_domainstatus;


class update
{
	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE domainstatus SET $set WHERE domainstatus.id = $_id LIMIT 1";
		$result = \dash\pdo::query($query, [], 'nic');
		return $result;
	}


	public static function update_by_domain_status($_args, $_domain, $_status)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE domainstatus SET $set WHERE domain = :domain AND active = 1 AND status = :status ";

		$param =
		[
			':domain' => $_domain,
			':status' => $_status,
		];

		$result = \dash\pdo::query($query, $param, 'nic');

		return $result;
	}


}
?>