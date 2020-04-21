<?php
namespace lib\db\nic_domainstatus;


class get
{
	public static function by_domain($_domain)
	{
		$query  = "SELECT *  FROM domainstatus WHERE domainstatus.domain = '$_domain' AND domainstatus.active = 1";
		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}


}
?>