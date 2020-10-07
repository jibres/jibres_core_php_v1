<?php
namespace dash\app\user;


class business
{

	public static function businesscount($_user_id = null)
	{
		// default business count for every user is 3
		$businesscount = 3;

		$id = \dash\validate::id($_user_id, false);

		if($id)
		{
			$load_user  = \dash\db\users::get_by_id($id);

			if(isset($load_user['businesscount']) && is_numeric($load_user['businesscount']))
			{
				$businesscount = floatval($load_user['businesscount']);
			}
		}

		return $businesscount;
	}




	/**
	 * edit a user
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function set($_args, $_id, $_option = [])
	{

		$default_option =
		[

		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		$id = $_id;
		$id = \dash\validate::code($id);
		$id = \dash\coding::decode($id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to edit user"), 'user');
			return false;
		}

		$load_user  = \dash\db\users::get_by_id($id);

		if(!isset($load_user['id']))
		{
			\dash\notif::error(T_("Invalid user id"));
			return false;
		}


		$condition =
		[
			'businesscount'           => 'int',
		];


		$require = [];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		if($data === false || !\dash\engine\process::status())
		{
			return false;
		}

		$update = $data;

		\dash\db\users::update($update, $id);

		\dash\notif::ok(T_("User successfully updated"));

		return true;
	}
}
?>