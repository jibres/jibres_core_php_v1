<?php
namespace lib;


class user
{

	private static $user = [];


	public static function refresh()
	{
		self::clean();
		self::init();
	}

	/**
	 * clean chach to load detail again
	 * user in edit user
	 */
	public static function clean()
	{
		\dash\session::set('user_detail_'. \lib\store::store_slug(). '_'. \dash\user::id(), null);
		self::$user = [];
	}


	/**
	 * initial user detail
	 */
	public static function init()
	{
		if(!empty(self::$user))
		{
			return;
		}

		if(\dash\session::get('user_detail_'. \lib\store::store_slug(). '_'. \dash\user::id()))
		{
			self::$user = \dash\session::get('user_detail_'. \lib\store::store_slug(). '_'. \dash\user::id());
			return;
		}

		if(!\lib\store::id())
		{
			return false;
		}

		if(!\dash\user::id())
		{
			return false;
		}

		$user_detail = \lib\db\users\get::user_id_detail(\dash\user::id());

		if(is_array($user_detail))
		{
			self::$user = $user_detail;
			\dash\session::set('user_detail_'. \lib\store::store_slug(). '_'. \dash\user::id(), $user_detail);
		}
	}


	public static function force_id()
	{
		if(!\lib\store::id() || !\dash\user::id())
		{
			return false;
		}

		if(self::id())
		{
			return self::id();
		}
		else
		{
			$user_detail = \lib\db\users\get::user_id_detail(\dash\user::id());

			if(isset($user_detail['id']))
			{
				return $user_detail['id'];
			}
			else
			{

				$insert_user =
				[
					'user_id'     => \dash\user::id(),
					'mobile'      => \dash\user::detail('mobile'),
					'displayname' => \dash\user::detail('displayname') ?  \dash\user::detail('displayname') : null,
					'firstname'   => \dash\user::detail('firstname') ?  \dash\user::detail('firstname') : null,
					'lastname'    => \dash\user::detail('lastname') ?  \dash\user::detail('lastname') : null,
					'avatar'      => \dash\user::detail('avatar') ?  \dash\user::detail('avatar') : null,
					'gender'      => \dash\user::detail('gender'),
				];

				$id = \lib\db\users\insert::new_row($insert_user);

				return $id;
			}
		}
	}


	/**
	 * get id of user
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function id()
	{
		self::init();

		if(isset(self::$user['id']))
		{
			return intval(self::$user['id']);
		}
		return null;
	}


	public static function user_id()
	{
		self::init();

		if(isset(self::$user['user_id']))
		{
			return intval(self::$user['user_id']);
		}
		return null;
	}


	/**
	 * get user detail
	 */
	public static function detail($_name = null)
	{
		self::init();

		if($_name)
		{
			if(array_key_exists($_name, self::$user))
			{
				return self::$user[$_name];
			}
			return null;
		}
		else
		{
			return self::$user;
		}
	}
}
?>
