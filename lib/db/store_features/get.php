<?php
namespace lib\db\store_features;


class get
{

	public static function by_business_id_lock($_business_id)
	{
		$query = "SELECT * FROM store_features WHERE store_features.store_id = :id FOR UPDATE";
		$param = [':id' => $_business_id];

		$result = \dash\pdo::get($query, $param);

		return $result;
	}


	public static function active_by_business_id($_business_id)
	{
		$query = "SELECT * FROM store_features WHERE store_features.store_id = :id AND store_features.status = 'enable' ";
		$param = [':id' => $_business_id];

		$result = \dash\pdo::get($query, $param);

		return $result;
	}


	public static function by_business_id($_business_id)
	{
		$query = "SELECT * FROM store_features WHERE store_features.store_id = :id ";
		$param = [':id' => $_business_id];

		$result = \dash\pdo::get($query, $param);

		return $result;
	}



	public static function by_business_id_feature($_business_id, $_feature)
	{
		$query = "SELECT * FROM store_features WHERE store_features.store_id = :id AND store_features.feature_key = :feature_key LIMIT 1";
		$param = [':id' => $_business_id, ':feature_key' => $_feature];

		$result = \dash\pdo::get($query, $param, null, true);

		return $result;
	}


}
?>
