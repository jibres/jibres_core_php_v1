<?php
namespace lib\app\cart;


class search
{

	public static function list()
	{
		if(!\dash\user::id())
		{
			// save in session
			// in api we have the user id
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$user_cart = \lib\db\cart\search::list();

		if(!$user_cart)
		{
			return null;
		}

		$user_cart = array_map(['\\lib\\app\\cart\\ready', 'row'], $user_cart);

		return $user_cart;
	}


	public static function detail($_user_id)
	{
		if(!\dash\user::id())
		{
			// save in session
			// in api we have the user id
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$_user_id = \dash\coding::decode($_user_id);
		if(!$_user_id)
		{
			\dash\notif::error(T_("Invalid user"));
			return false;
		}

		$and            = [];
		$and['user_id'] = $_user_id;

		$user_cart = \lib\db\cart\search::detail($and);

		if(!$user_cart)
		{
			return null;
		}

		$user_cart = array_map(['\\lib\\app\\cart\\ready', 'row'], $user_cart);

		return $user_cart;
	}
}
?>