<?php
namespace lib\db\business_domain;


class get
{


	public static function by_domain($_domain)
	{
		$query  = " SELECT * FROM business_domain WHERE business_domain.domain = '$_domain' LIMIT 1 ";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}


	public static function by_id($_id)
	{
		$query  = " SELECT * FROM business_domain WHERE business_domain.id = '$_id' LIMIT 1 ";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}

}
?>
