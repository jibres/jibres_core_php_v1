<?php
namespace lib\app\form\comment;


class remove
{
	public static function remove($_id)
	{


		$get = \lib\app\form\comment\get::one($_id);
		if(!$get)
		{
			return false;
		}

		\lib\db\form_comment\delete::record($_id);

		\dash\notif::ok(T_("Comment removed"));

		return true;

	}
}
?>