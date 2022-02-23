<?php
namespace lib\db\business_domain;


class update
{
	public static function update($_args, $_id)
	{
		return \dash\pdo\query_template::update('business_domain', $_args, $_id, 'master');
	}


	public static function update_dns($_args, $_id)
	{
		return \dash\pdo\query_template::update('business_domain_dns', $_args, $_id, 'master');
	}

	public static function update_id_store_id($_args, $_id, $_store_id)
	{
		$q      = \dash\pdo\prepare_query::generate_set('business_domain', $_args);

		$query  = "UPDATE `business_domain` SET $q[set] WHERE business_domain.id = :id AND business_domain.store_id = :store_id LIMIT 1 ";

		$param  = array_merge($q['param'], [':id' => $_id, ':store_id' => $_store_id]);

		$result = \dash\pdo::query($query, $param, 'master');

		return $result;

	}

	public static function reset_all_master_store($_store_id)
	{
		$query = " UPDATE `business_domain` SET business_domain.master = NULL WHERE business_domain.store_id = $_store_id ";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}


	public static function reset_all_redirect_store($_store_id, $_value)
	{
		$query = " UPDATE `business_domain` SET business_domain.redirecttomaster = $_value WHERE business_domain.store_id = $_store_id ";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}


	public static function re_pending_dns_not_active()
	{
		$query = " UPDATE `business_domain` SET business_domain.status = 'pending' WHERE business_domain.status = 'dns_not_resolved' ";
		$result = \dash\pdo::query($query, [], 'master');
		return $result;
	}





}
?>
