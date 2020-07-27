<?php
namespace lib\db\store_domain;


class get
{

	public static function check_duplicate($_domain)
	{
		$query  = "SELECT * FROM store_domain WHERE store_domain.domain = '$_domain' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


	public static function by_domain($_domain)
	{
		$query  = "SELECT * FROM store_domain WHERE store_domain.domain = '$_domain' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


	public static function by_store_id($_store_id)
	{
		$query  = "SELECT * FROM store_domain WHERE store_domain.store_id = $_store_id ORDER BY store_domain.master desc";
		$result = \dash\db::get($query, null, false, 'master');
		return $result;
	}


	public static function is_customer_domain($_domain)
	{
		$query  = "SELECT * FROM store_domain WHERE store_domain.domain = '$_domain' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


}
?>
