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



	public static function my_ticket()
	{
		$id = \dash\request::get('id');
		$id = \dash\validate::id($id);
		if(!$id)
		{
			return false;
		}

		$user_id = \dash\user::id();
		if(!$user_id)
		{
			return false;
		}


		$load = \dash\db\tickets\get::load_my_ticket($id, $user_id);

		if(!$load)
		{
			return false;
		}

		$load = \dash\app\ticket\ready::row($load);


		return $load;


	}

	public static function conversation($_id)
	{
		\dash\permission::access('crmTicketManager');

		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$conversation = \dash\db\tickets\get::conversation($id);
		if(!is_array($conversation))
		{
			$conversation = [];
		}

		$conversation = array_map(['\\dash\\app\\ticket\\ready', 'row'], $conversation);

		return $conversation;
	}
}
?>