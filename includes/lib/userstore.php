<?php
namespace lib;


class userstore
{

	private static $userstore = [];


	/**
	 * clean chach to load detail again
	 * user in edit userstore
	 */
	public static function clean()
	{
		\lib\session::set('userstore_detail_'. \lib\url::subdomain(). '_'. \lib\user::id(), null);
		self::$userstore = [];
	}


	/**
	 * initial userstore detail
	 */
	public static function init()
	{
		if(!empty(self::$userstore))
		{
			return;
		}

		if(\lib\session::get('userstore_detail_'. \lib\url::subdomain(). '_'. \lib\user::id()))
		{
			self::$userstore = \lib\session::get('userstore_detail_'. \lib\url::subdomain(). '_'. \lib\user::id());
			return;
		}

		if(!\lib\store::id())
		{
			return false;
		}

		$get = ['store_id' => \lib\store::id(), 'user_id' => \lib\user::id(), 'limit' => 1];
		$userstore_detail = \lib\db\userstores::get($get);

		if(is_array($userstore_detail))
		{
			self::$userstore = $userstore_detail;
			\lib\session::set('userstore_detail_'. \lib\url::subdomain(). '_'. \lib\user::id(), $userstore_detail);
		}
	}


	/**
	 * get id of userstore
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function id()
	{
		self::init();

		if(isset(self::$userstore['id']))
		{
			return intval(self::$userstore['id']);
		}
		return null;
	}


	/**
	 * get userstore detail
	 */
	public static function detail($_name = null)
	{
		self::init();

		if($_name)
		{
			if(array_key_exists($_name, self::$userstore))
			{
				return self::$userstore[$_name];
			}
			return null;
		}
		else
		{
			return self::$userstore;
		}
	}


	public static function in_store()
	{
		return self::id();
	}
}
?>
