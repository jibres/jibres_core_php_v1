<?php
namespace lib\db\ipg\iban;


class get
{
	public static function my_default_iban($_user_id)
	{
		$query  = "SELECT *  FROM iban WHERE iban.user_id = $_user_id AND iban.isdefault = 1 AND iban.status != 'deleted'  LIMIT 1";
		$result = \dash\db::get($query, null, true, 'shaparak');
		return $result;
	}



	public static function my_iban($_user_id)
	{
		$query  = "SELECT *  FROM iban WHERE iban.user_id = $_user_id AND iban.status != 'deleted' ORDER BY iban.id DESC";
		$result = \dash\db::get($query, null, false, 'shaparak');
		return $result;
	}


	public static function check_duplicate_ibann($_iban, $_user_id)
	{
		$query  = "SELECT *  FROM iban WHERE iban.user_id = $_user_id AND iban.iban = '$_iban' AND iban.status != 'deleted' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'shaparak');
		return $result;
	}

}
?>