<?php
namespace content_my\store\start;


class controller
{
	public static function routing()
	{
		\dash\session::clean_cat('CreateNewStore');

		$can_add_new_store = \lib\app\store\add::can(true, false);
		\dash\data::canAddStore($can_add_new_store);
	}
}
?>
