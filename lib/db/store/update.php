<?php
namespace lib\db\store;


class update
{
	public static function store_data($_field, $_value, $_store_id)
	{
		$query = "UPDATE store_data SET store_data.$_field = '$_value' WHERE store_data.id = $_store_id LIMIT 1";
		$result = \dash\db::query($query, 'master');
		return $result;

	}

	public static function subdomain($_subdomain, $_id)
	{
		$date = date("Y-m-d H:i:s");

		$query = "UPDATE store SET store.subdomain = '$_subdomain', store.datemodified = '$date' WHERE store.id = $_id LIMIT 1";
		$result = \dash\db::query($query, 'master');
		return $result;

	}
}
?>