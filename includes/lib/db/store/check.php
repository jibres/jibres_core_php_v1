<?php
namespace lib\db\store;


class check
{
	public static function subdomain_exist($_subdomain)
	{
		$query = "SELECT * FROM store WHERE store.subdomain = '$_subdomain' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>