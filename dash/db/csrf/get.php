<?php
namespace dash\db\csrf;


class get
{
	public static function check($_token, $_urlmd5)
	{
		$query = "SELECT * FROM csrf WHERE csrf.token = '$_token' AND csrf.urlmd5 = '$_urlmd5' AND csrf.status IN ('active', 'used') LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true, null, ['ignore_error' => true]);
		return $result;
	}

}
?>