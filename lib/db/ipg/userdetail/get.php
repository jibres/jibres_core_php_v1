<?php
namespace lib\db\ipg\userdetail;


class get
{
	public static function my_detail($_user_id)
	{
		$query  = "SELECT *  FROM userdetail WHERE userdetail.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'ipg');
		return $result;
	}


}
?>