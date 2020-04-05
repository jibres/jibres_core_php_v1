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
}
?>
