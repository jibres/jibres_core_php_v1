<?php
namespace dash\db\login;


class get
{
	public static function load_code($_code)
	{
		$query = "SELECT * FROM login WHERE login.code = '$_code' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function load_code_force_jibres($_code)
	{
		$query = "SELECT * FROM login WHERE login.code = '$_code' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'master');
		return $result;
	}




}
?>