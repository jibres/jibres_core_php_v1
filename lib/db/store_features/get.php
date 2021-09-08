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


	public static function by_business_id($_business_id)
	{
		$query = "SELECT * FROM store_features WHERE store_features.store_id = :id";
		$param = [':id' => $_business_id];

		$result = \dash\pdo::get($query, $param);

		return $result;
	}
}
?>
