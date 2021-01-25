<?php
namespace dash\app\ticket;

class get
{

	public static function get($_id)
	{
		\dash\permission::access('crmTicketManager');

		$load = self::inline_get($_id);

		if(!$load)
		{
			return false;
		}

		$load = \dash\app\ticket\ready::row($load);

		return $load;
	}


	public static function inline_get($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$load = \dash\db\tickets\get::get($id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Data not founded"));
			return false;
		}

		return $load;
	}



	public static function my_ticket($_id = null, $_website_mode = false)
	{
		if($_id)
		{
			$id = $_id;
		}
		else
		{
			$id = \dash\request::get('id');
		}

		$id = \dash\validate::id($id);
		if(!$id)
		{
			return false;
		}

		$guestid = null;
		$user_id = \dash\user::id();
		if(!$user_id)
		{
			$guestid = \dash\user::get_user_guest();
			if(!$guestid)
			{
				if($_website_mode)
				{
					// redirect to login to login user and see it
					\dash\redirect::to_login();
				}
				else
				{
					return false;
				}
			}
		}

		if($user_id)
		{
			$load = \dash\db\tickets\get::load_my_ticket($id, $user_id, $guestid);
		}
		elseif($guestid)
		{
			$load = \dash\db\tickets\get::load_my_ticket_guestid($id, $guestid);
		}
		else
		{
			return false;
		}


		if(!$load)
		{
			return false;
		}

		$load = \dash\app\ticket\ready::row($load);


		return $load;


	}

	public static function conversation($_id, $_customer_mode = false)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$conversation = \dash\db\tickets\get::conversation($id, $_customer_mode);
		if(!is_array($conversation))
		{
			$conversation = [];
		}

		$conversation = array_map(['\\dash\\app\\ticket\\ready', 'row'], $conversation);

		return $conversation;
	}
}
?>