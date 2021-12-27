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
		$set = \dash\db\config::make_set($_args);
		if($set)
		{
			$query = " UPDATE `business_domain` SET $set WHERE business_domain.id = $_id AND business_domain.store_id = $_store_id LIMIT 1 ";
			return \dash\pdo::query($query, [], 'master');
		}
		else
		{
			return false;
		}
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





}
?>
