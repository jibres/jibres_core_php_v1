<?php
namespace lib;

////////////// STORE USER //////////////
class user
{

	private static $user = [];


	public static function refresh()
	{
		self::clean();
		self::init();
	}


	private static function sessionKey()
	{
		return 'user_detail_'. \lib\store::store_slug(). '_'. \dash\user::id();
	}


	private static function sessionCat()
	{
		return 'jibres_user_store';
	}


	/**
	 * clean chach to load detail again
	 * user in edit user
	 */
	public static function clean()
	{
		\dash\session::clean_cat(self::sessionCat());
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

		if(\dash\session::get(self::sessionKey(), self::sessionCat()))
		{
			self::$user = \dash\session::get(self::sessionKey(), self::sessionCat());
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

		$user_detail = \lib\db\users\get::jibres_user_id_detail(\dash\user::id());

		if(is_array($user_detail))
		{
			self::$user = $user_detail;
			\dash\session::set(self::sessionKey(), $user_detail, self::sessionCat());
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
