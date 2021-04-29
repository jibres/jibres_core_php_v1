<?php
namespace lib\pagebuilder\tools;


class remove
{
	public static function remove_page($_id)
	{
		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\pagebuilder\tools\current_post::load($id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid record type"));
			return false;
		}

		if(isset($load['ishomepage']) && $load['ishomepage'])
		{
			\dash\notif::error(T_("Can not remove homepage"));
			return false;
		}

		\lib\db\pagebuilder\delete::page_compelet($id);

		\dash\notif::ok(T_("Page successfully removed"));

		return true;


	}
}
?>