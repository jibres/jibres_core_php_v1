<?php
namespace lib\db\ipg\iban;


class get
{
	public static function my_default_iban($_user_id)
	{
		$query  = "SELECT *  FROM iban WHERE iban.user_id = $_user_id AND iban.isdefault = 1 LIMIT 1";
		$result = \dash\db::get($query, null, true, 'ipg');
		return $result;
	}


}
?>