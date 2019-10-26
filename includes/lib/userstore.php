<?php
namespace lib;


class userstore
{

	private static $userstore = [];


	public static function refresh()
	{
		self::clean();
		self::init();
	}

	/**
	 * clean chach to load detail again
	 * user in edit userstore
	 */
	public static function clean()
	{
		\dash\session::set('userstore_detail_'. \lib\store::store_slug(). '_'. \dash\user::id(), null);
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

		if(\dash\session::get('userstore_detail_'. \lib\store::store_slug(). '_'. \dash\user::id()))
		{
			self::$userstore = \dash\session::get('userstore_detail_'. \lib\store::store_slug(). '_'. \dash\user::id());
			return;
		}

		if(!\lib\store::id())
		{
			return false;
		}

		$userstore_detail = \lib\db\userstore\get::user_id_detail(\dash\user::id());

		if(is_array($userstore_detail))
		{
			self::$userstore = $userstore_detail;
			\dash\session::set('userstore_detail_'. \lib\store::store_slug(). '_'. \dash\user::id(), $userstore_detail);
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
			$userstore_detail = \lib\db\userstore\get::user_id_detail(\dash\user::id());

			if(isset($userstore_detail['id']))
			{
				return $userstore_detail['id'];
			}
			else
			{

				$insert_userstore =
				[
					'user_id'     => \dash\user::id(),
					'mobile'      => \dash\user::detail('mobile'),
					'displayname' => \dash\user::detail('displayname') ?  \dash\user::detail('displayname') : null,
					'firstname'   => \dash\user::detail('firstname') ?  \dash\user::detail('firstname') : null,
					'lastname'    => \dash\user::detail('lastname') ?  \dash\user::detail('lastname') : null,
					'avatar'      => \dash\user::detail('avatar') ?  \dash\user::detail('avatar') : null,
					'gender'      => \dash\user::detail('gender'),
				];

				$id = \lib\db\userstores\insert::new_row($insert_userstore);

				return $id;
			}
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


	public static function user_id()
	{
		self::init();

		if(isset(self::$userstore['user_id']))
		{
			return intval(self::$userstore['user_id']);
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
}
?>
