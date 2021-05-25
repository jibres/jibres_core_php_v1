<?php
namespace dash\db;


class useremail
{
	public static function get_by_user_id($_user_id)
	{
		$query = "SELECT * FROM useremail WHERE useremail.user_id = $_user_id  AND useremail.status = 'enable' ORDER BY  FIELD(useremail.primary, 1), FIELD(useremail.verify, 1) ";

		$result = \dash\db::get($query);
		return $result;
	}


	public static function get_count_by_user_id($_user_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM useremail WHERE useremail.user_id = $_user_id AND useremail.status = 'enable' ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function set_verify($_id)
	{
		$query = "UPDATE useremail SET useremail.verify = 1 WHERE useremail.id = $_id  LIMIT 1 ";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function get_user_email_primary($_user_id)
	{
		$query = "SELECT * FROM useremail WHERE useremail.user_id = $_user_id AND useremail.status = 'enable' ORDER BY useremail.id DESC, FIELD(useremail.verify, 1), FIELD(useremail.primary, 1) LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function check_is_verify_for_other($_email)
	{
		$query = "SELECT * FROM useremail WHERE useremail.emailraw = '$_email' AND useremail.verify = 1 LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function check_is_my_email_raw($_emailraw, $_user_id)
	{
		$query = "SELECT * FROM useremail WHERE useremail.emailraw = '$_emailraw' AND useremail.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function check_is_my_email_id($_id, $_user_id)
	{
		$query = "SELECT * FROM useremail WHERE useremail.id = '$_id' AND useremail.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function check_duplicate_email($_email, $_user_id)
	{
		$query = "SELECT * FROM useremail WHERE useremail.emailraw = '$_email' AND useremail.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function remove_all_other_primary($_user_id)
	{
		$query = "UPDATE useremail SET useremail.primary = NULL WHERE useremail.user_id = $_user_id ";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function update()
	{
		return \dash\db\config::public_update('useremail', ...func_get_args());
	}

	public static function set_primary_id($_id)
	{
		$query = "UPDATE useremail SET useremail.primary = 1 WHERE useremail.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function remove($_id, $_user_id)
	{
		$query =
		"
			UPDATE
				useremail
			SET
				useremail.status  = 'delete',
				useremail.primary = NULL,
				useremail.verify  = NULL
			WHERE
				useremail.id   = '$_id' AND
				useremail.user_id = $_user_id
			LIMIT 1
		";

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
