<?php
namespace lib\db\ipg\wallet;


class get
{
	public static function my_default_wallet($_user_id)
	{
		$query  = "SELECT *  FROM wallet WHERE wallet.user_id = $_user_id AND wallet.isdefault = 1 AND wallet.status != 'deleted'  LIMIT 1";
		$result = \dash\db::get($query, null, true, 'ipg');
		return $result;
	}



	public static function my_wallet($_user_id)
	{
		$query  = "SELECT *  FROM wallet WHERE wallet.user_id = $_user_id AND wallet.status != 'deleted' ORDER BY wallet.id DESC";
		$result = \dash\db::get($query, null, false, 'ipg');
		return $result;
	}


	public static function check_duplicate_walletn($_title, $_user_id)
	{
		$query  = "SELECT *  FROM wallet WHERE wallet.user_id = $_user_id AND wallet.title = '$_title' AND wallet.status != 'deleted' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'ipg');
		return $result;
	}

}
?>