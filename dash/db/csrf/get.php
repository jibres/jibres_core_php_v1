<?php
namespace dash\db\csrf;


class get
{
	public static function check($_token, $_urlmd5)
	{
		$query = "SELECT * FROM csrf WHERE csrf.token = '$_token' AND csrf.urlmd5 = '$_urlmd5' AND csrf.status = 'active' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

}
?>