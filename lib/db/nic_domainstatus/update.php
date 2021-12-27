<?php
namespace lib\db\nic_domainstatus;


class update
{
	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('domainstatus', $_args, $_id, 'nic');
	}


	public static function update_by_domain_status($_args, $_domain, $_status)
	{

		$q      = \dash\pdo\prepare_query::generate_set('domainstatus', $_args);

		$query  = "UPDATE domainstatus SET $set WHERE domain = :domain AND active = 1 AND status = :status ";

		$param  = array_merge($q['param'], [':domain' => $_domain, ':status' => $_status]);

		$result = \dash\pdo::query($query, $param, 'nic');

		return $result;
	}


}
?>