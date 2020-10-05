<?php
namespace dash\db\login;

/**
 * STATUS OF LOGIN RECORD
 * 'active'
	'expire'
	'logout'
	'changepassword'
	'deleted'
	'hijack'
	'changeip'
	'changeagent'
	'block'
	'error'
 */

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


	public static function terminate_all_other_session($_user_id, $_current_login_id = null)
	{
		$date = date("Y-m-d H:i:s");
		$current_login_id = null;

		if($_current_login_id)
		{
			$current_login_id = " AND login.id != $_current_login_id ";
		}

		$query = "UPDATE login SET login.status = 'deleted', login.datemodified = '$date' WHERE login.user_id = $_user_id AND login.status = 'active' $current_login_id ";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function terminate_id($_id, $_user_id)
	{
		$date = date("Y-m-d H:i:s");
		$query = "UPDATE login SET login.status = 'deleted', login.datemodified = '$date' WHERE login.id = $_id AND login.user_id = $_user_id AND login.status = 'active' LIMIT 1 ";
		$result = \dash\db::query($query);
		return $result;
	}



	public static function remove_old_expire()
	{
		$date = date("Y-m-d H:i:s", strtotime("-30 days"));

		$query =
		"
			SELECT
				login.id AS `id`
			FROM
				login
			WHERE
				login.status = 'active' AND
				login.datecreated < '$date'
		";

		$get_list = \dash\db::get($query, 'id', false);
		if(!$get_list || !is_array($get_list) || empty($get_list))
		{
			return true;
		}

		$id = implode(',', $get_list);

		$query =
		"
			UPDATE
				login
			SET
				login.status = 'expire'
			WHERE
				login.id IN ($id)

		";

		$ok = \dash\db::query($query);
		if($ok)
		{
			\dash\log::set('AutoExpireSession', ['countsession' => count($get_list)]);
		}

	}


}
?>