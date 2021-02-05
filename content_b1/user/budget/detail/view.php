<?php
namespace content_b1\user\budget\detail;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$budget = \dash\user::get_budget($id);

		$detail = ['budget' => $budget];

		\content_b1\tools::say($detail);
	}
}
?>