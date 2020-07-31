<?php
namespace dash\db;


class useremail
{
	public static function get_by_user_id($_user_id)
	{
		$query = "SELECT * FROM useremail WHERE useremail.user_id = $_user_id";
		$result = \dash\db::get($query);
		return $result;
	}

	public static function get_count_by_user_id($_user_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM useremail WHERE useremail.user_id = $_user_id";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}




	public static function check_is_verify_for_other($_email)
	{
		$query = "SELECT * FROM useremail WHERE useremail.email = '$_email' AND useremail.verify = 1 LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function check_duplicate_email($_email, $_user_id)
	{
		$query = "SELECT * FROM useremail WHERE useremail.email = '$_email' AND useremail.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function remove_all_other_primary($_user_id)
	{
		$query = "UPDATE useremail SET useremail.primary = NULL WHERE useremail.user_id = $_user_id ";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function set_primary_id($_id)
	{
		$query = "UPDATE useremail SET useremail.primary = 1 WHERE useremail.id = $_id ";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function remove($_email, $_user_id)
	{
		$query = "DELETE FROM useremail WHERE useremail.email = '$_email' AND useremail.user_id = $_user_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function insert($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `useremail` SET $set ";
			if(\dash\db::query($query))
			{
				return \dash\db::insert_id();
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

}
?>
