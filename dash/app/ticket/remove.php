<?php
namespace dash\app\ticket;

class remove
{

	public static function remove($_id)
	{
		\dash\permission::access('crmTicketManager');

		$load = \dash\app\ticket\get::inline_get($_id);
		if(!$load)
		{
			return false;
		}

		if(isset($load['parent']) && $load['parent'])
		{
			// nothing to remove
		}
		else
		{
			\dash\notif::error(T_("Can not remove master message in ticket!"));
			return false;
		}

		if(isset($load['type']) && $load['type'] === 'action')
		{
			\dash\notif::error(T_("Can not remove this ticket"));
			return false;
		}



		\dash\db\tickets\update::set_base_null($load['id']);
		\dash\db\tickets\delete::delete($load['id']);

		\dash\notif::ok(T_('Message removed'));

		return true;


	}


}
?>