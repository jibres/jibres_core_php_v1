<?php
namespace lib\db\store;


class get
{
	public static function detail($_store_id)
	{
		$query = "SELECT * FROM store WHERE store.id = $_store_id LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function count_free_trial($_user_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM store_data WHERE store_data.owner = $_user_id AND store_data.plan IN ('free', 'trial') ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function subdomain_detail($_subdomain)
	{
		$query = "SELECT * FROM store WHERE store.subdomain = '$_subdomain' LIMIT 1 ";
		$result = \dash\db::get($query, null, true);
		if(isset($result['id']))
		{
			$query      = "SELECT * FROM store_data WHERE store_data.id = '$result[id]' LIMIT 1 ";
			$store_data = \dash\db::get($query, null, true);

			$result['store_data'] = $store_data;
		}
		return $result;
	}



}
?>