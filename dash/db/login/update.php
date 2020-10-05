<?php
namespace dash\db\login;


class update
{
	public static function logout($_id)
	{
		$date = date("Y-m-d H:i:s");
		$query = "UPDATE login SET login.status = 'logout', login.datemodified = '$date' WHERE login.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function change_password($_user_id)
	{
		$date = date("Y-m-d H:i:s");
		$query = "UPDATE login SET login.status = 'changepassword', login.datemodified = '$date' WHERE login.user_id = $_user_id AND login.status = 'active' ";
		$result = \dash\db::query($query);
		return $result;
	}




}
?>