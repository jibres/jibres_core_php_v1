<?php
namespace dash\db\users;


class insert
{

	public static function jibres_customer_users_insert($_database, $_fuel, $_set)
	{
		return \dash\pdo\query_template::insert('users', $_set, $_fuel, ['database' => $_database]);
	}

	public static function insert($_args)
	{
		return \dash\pdo\query_template::insert('users', $_args);
	}




	/**
	 * check signup and if can add new user
	 * @return [type] [description]
	 */
	public static function signup($_args = [])
	{

		if(isset($_args['mobile']) && $_args['mobile'])
		{
			$mobile = \dash\validate::mobile($_args['mobile'], false);
			if(!$mobile)
			{
				return false;
			}

			$check = \dash\db\users::get_by_mobile($mobile);

			if(isset($check['id']))
			{
				return $check['id'];
			}
		}


		if(isset($_args['username']) && $_args['username'])
		{
			$check_username = \dash\db\users::get_by_username($_args['username']);

			if(isset($check_username['id']))
			{
				return false; // $check_username['id'];
			}
		}


		if(isset($_args['email']) && $_args['email'])
		{
			$check_email = \dash\db\users::get_by_email($_args['email']);

			if(isset($check_email['id']))
			{
				return false; // $check_email['id'];
			}
		}

		// signup up users
		$_args['datecreated'] = date("Y-m-d H:i:s");

		$insert_id    = self::insert($_args);

		return $insert_id;

	}


	public static function jibres_insert($_args)
	{
		return \dash\pdo\query_template::insert('users', $_args, 'master');
	}




	/**
	 * check signup and if can add new user
	 * @return [type] [description]
	 */
	public static function jibres_signup($_args = [])
	{

		if(isset($_args['mobile']) && $_args['mobile'])
		{
			$mobile = \dash\validate::mobile($_args['mobile'], false);
			if(!$mobile)
			{
				return false;
			}

			$check = \dash\db\users::jibres_get_by_mobile($mobile);

			if(isset($check['id']))
			{
				return $check['id'];
			}
		}


		if(isset($_args['username']) && $_args['username'])
		{
			$check_username = \dash\db\users::jibres_get_by_username($_args['username']);

			if(isset($check_username['id']))
			{
				return false; // $check_username['id'];
			}
		}


		if(isset($_args['email']) && $_args['email'])
		{
			$check_email = \dash\db\users::jibres_get_by_email($_args['email']);

			if(isset($check_email['id']))
			{
				return false; // $check_email['id'];
			}
		}

		// signup up users
		$_args['datecreated'] = date("Y-m-d H:i:s");

		$insert_id    = self::jibres_insert($_args);

		return $insert_id;

	}

}
?>