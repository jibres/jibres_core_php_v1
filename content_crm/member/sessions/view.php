<?php
namespace content_crm\member\sessions;

class view
{

	public static function config()
	{

		\content_crm\member\master::view();

		\dash\face::title(T_("Sessions"));

		$user_id = \dash\coding::decode(\dash\request::get('id'));

		$list    = \dash\login::get_active_sessions($user_id);

		\dash\data::dataTable($list);

		\dash\data::listEngine_start(true);


	}



}
?>