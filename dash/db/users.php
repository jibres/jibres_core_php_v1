<?php
namespace dash\db;


class users
{

	public static $USERS_DETAIL = [];

	public static $user_id;


	public static function all_user_mobile($_where = null)
	{
		$where = null;

		if($_where)
		{
			$where = \dash\db\config::make_where($_where);
			if($where)
			{
				$where = " AND $where";
			}
		}

		$query = "SELECT users.mobile AS `mobile` FROM users WHERE users.mobile IS NOT NULL  $where";

		return \dash\db::get($query, 'mobile');
	}

	/**
	 * Counts the number of ok users.
	 * Not deleted and not unreachible
	 */
	public static function count_ok_users()
	{
		$query = "SELECT COUNT(*) AS `count` FROM users WHERE users.status NOT IN ('removed', 'unreachable') ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function count_users_have_permission()
	{
		$query = "SELECT COUNT(*) AS `count` FROM users WHERE users.status NOT IN ('removed', 'unreachable') AND users.permission IS NOT NULL ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function update_where($_set, $_where)
	{
		return \dash\db\config::public_update_where('users', ...func_get_args());
	}


	public static function get()
	{
		$result = \dash\db\config::public_get('users', ...func_get_args());
		return $result;
	}


	public static function hard_delete($_id)
	{
		if(!$_id || !is_numeric($_id))
		{
			return false;
		}

		$query = "DELETE FROM users WHERE users.id = $_id LIMIT 1";
		return \dash\db::query($query);
	}


	public static function get_ref_count($_args)
	{
		$where = \dash\db\config::make_where($_args);
		if($where)
		{
			$query = "SELECT COUNT(*) AS `count` FROM users WHERE $where ";
			return \dash\db::get($query, 'count', true);
		}
	}


	public static function get_by_mobile($_mobile)
	{
		$query = "SELECT * FROM users WHERE users.mobile = '$_mobile' ORDER BY users.id ASC LIMIT 1";
		return \dash\db::get($query, null, true);
	}


	public static function get_by_jibres_user_id($_user_id)
	{
		$query = "SELECT * FROM users WHERE users.jibres_user_id = '$_user_id' LIMIT 1";
		return \dash\db::get($query, null, true);
	}


	public static function jibres_get_by_mobile($_mobile)
	{
		$query = "SELECT * FROM users WHERE users.mobile = '$_mobile' ORDER BY users.id ASC LIMIT 1";
		return \dash\db::get($query, null, true, 'master');
	}


	public static function jibres_get_by_email($_email)
	{
		$query = "SELECT * FROM users WHERE users.email = '$_email' ORDER BY users.id ASC LIMIT 1 ";
		return \dash\db::get($query, null, true, 'master');
	}


	public static function jibres_get_by_username($_username)
	{
		$query = "SELECT * FROM users WHERE users.username = '$_username' ORDER BY users.id ASC LIMIT 1";
		return \dash\db::get($query, null, true, 'master');
	}




	public static function get_by_displayname($_displayname)
	{
		$query = "SELECT * FROM users WHERE users.displayname = '$_displayname' LIMIT 1";
		return \dash\db::get($query, null, true);
	}


	public static function get_by_id($_user_id)
	{
		$query = "SELECT * FROM users WHERE users.id = '$_user_id' LIMIT 1";
		return \dash\db::get($query, null, true);
	}


	public static function get_by_email($_email)
	{
		$query = "SELECT * FROM users WHERE users.email = '$_email' ORDER BY users.id ASC LIMIT 1 ";
		return \dash\db::get($query, null, true);
	}


	public static function get_by_username($_username)
	{
		$query = "SELECT * FROM users WHERE users.username = '$_username' ORDER BY users.id ASC LIMIT 1";
		return \dash\db::get($query, null, true);
	}

	public static function search($_string = null, $_options = [])
	{
		if(!is_array($_options))
		{
			$_options = [];
		}
		$default_options = [];


		if($_string)
		{
			$search_field =
			"
				(
					users.nationalcode = '__string__' OR
					users.displayname LIKE '%__string__%'
				)
			";

			$mobile = \dash\validate::mobile($_string, false);
			if($mobile || is_numeric($_string))
			{
				$search_field =
				"
					(
						users.mobile = '$mobile' OR
						users.nationalcode = '__string__'
					)
				";
			}
			else
			{
				$search_field =
				"
					(
						users.displayname LIKE '%__string__%'
					)
				";
			}

			$default_options['search_field'] = $search_field;

		}

		$_options = array_merge($default_options, $_options);

		// public_show_field
		return \dash\db\config::public_search('users', $_string, $_options);
	}



	private static function insert()
	{
		return \dash\db\config::public_insert('users', ...func_get_args());
	}


	public static function update($_args, $_id)
	{
		if(isset($_args['mobile']) && $_args['mobile'])
		{
			// check not duplicate mobile
			$check_mobile = self::get_by_mobile($_args['mobile']);
			if($check_mobile && isset($check_mobile['id']))
			{
				if(floatval($check_mobile['id']) !== floatval($_id))
				{
					// this mobile exist for another person
					\dash\log::set('TryDuplicateUserMobile');
					return false;
				}
			}
		}

		if(isset($_args['email']) && $_args['email'])
		{
			// check not duplicate email
			$check_email = self::get_by_email($_args['email']);
			if($check_email && isset($check_email['id']))
			{
				if(floatval($check_email['id']) !== floatval($_id))
				{
					// this email exist for another person
					\dash\log::set('TryDuplicateUserEmail');
					return false;
				}
			}
		}


		// if(isset($_args['chatid']) && $_args['chatid'])
		// {
		// 	// check not duplicate chatid
		// 	$check_chatid = self::get_by_chatid($_args['chatid']);
		// 	if($check_chatid && isset($check_chatid['id']))
		// 	{
		// 		if(floatval($check_chatid['id']) !== floatval($_id))
		// 		{
		// 			// this chatid exist for another person
		// 			\dash\log::set('TryDuplicateUserChatid');
		// 			return false;
		// 		}
		// 	}
		// }

		if(isset($_args['username']) && $_args['username'])
		{
			// check not duplicate username
			$check_username = self::get_by_username($_args['username']);
			if($check_username && isset($check_username['id']))
			{
				if(floatval($check_username['id']) !== floatval($_id))
				{
					// this username exist for another person
					\dash\log::set('TryDuplicateUserUsername');
					return false;
				}
			}
		}

		return \dash\db\config::public_update('users', $_args, $_id);
	}




	public static function get_count()
	{
		return \dash\db\config::public_get_count('users', ...func_get_args());
	}


	public static function permission_group()
	{
		$query = "SELECT COUNT(*) AS `count`, users.permission AS `permission` FROM users GROUP BY users.permission";
		return \dash\db::get($query, ['permission', 'count']);
	}

	public static function get_by_permission($_permission)
	{
		$permission_query = null;
		if(is_array($_permission))
		{
			$permission_query = " IN ('". implode("','", $_permission). "') ";
		}
		else
		{
			$permission_query = " = '$_permission' ";
		}

		$query =
		"
			SELECT
				users.id,
				users.permission,
				users.mobile,
				users.avatar,
				users.gender,
				users.displayname
			FROM
				users
			WHERE
				users.permission $permission_query
		";

		$result = \dash\db::get($query);
		return $result;
	}


	public static function get_gender_chart()
	{
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				users.gender AS `gender`
			FROM
				users
			GROUP BY users.gender
		";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function get_status_chart()
	{
		$query =
		"
			SELECT
				COUNT(*) AS `count`,
				users.status AS `status`
			FROM
				users
			GROUP BY users.status
		";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function get_identify_chart()
	{
		$query =
		"
				SELECT COUNT(*) AS `count`, 'mobile' 	AS `type`	FROM users WHERE users.mobile 	IS NOT NULL
			UNION
				SELECT COUNT(*) AS `count`, 'Without mobile' 	AS `type`	FROM users WHERE users.mobile 	IS NULL
			UNION
				SELECT COUNT(*) AS `count`, 'email' 	AS `type`	FROM users WHERE users.email 	IS NOT NULL
			UNION
				SELECT COUNT(*) AS `count`, 'username' 	AS `type`	FROM users WHERE users.username IS NOT NULL
			UNION
				SELECT COUNT(*) AS `count`, 'chatid' 	AS `type`	FROM user_telegram
			UNION
				SELECT COUNT(*) AS `count`, 'android' 	AS `type`	FROM user_android
		";

		$result = \dash\db::get($query, null, true);
		return $result;
	}




	public static function find_user_to_login($_find)
	{
		if(!trim($_find))
		{
			return false;
		}

		// if email search only in email
		if(\dash\validate::mobile($_find, false))
		{
			// mobile in mobile
			$fix_mobile = \dash\validate::mobile($_find);
			$query      = "SELECT * FROM users WHERE users.mobile = '$fix_mobile' ORDER BY users.id ASC LIMIT 1";
		}
		elseif(filter_var($_find, FILTER_VALIDATE_EMAIL))
		{
			$query 		= "SELECT * FROM users WHERE users.email = '$_find' ORDER BY users.id ASC LIMIT 1";
		}
		elseif(preg_match("/^[A-Za-z0-9\_\-]+$/", $_find) && preg_match("/[A-Za-z]+/", $_find))
		{
			// a-z0-9 in username
			$query 		= "SELECT * FROM users WHERE  users.username = '$_find' ORDER BY users.id ASC LIMIT 1";
		}
		else
		{
			return false;
		}

		$find_user = \dash\db::get($query, null, true);

		if($find_user)
		{
			return $find_user;
		}

		return false;
	}
}
?>
