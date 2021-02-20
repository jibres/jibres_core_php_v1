<?php
namespace content_su\query;


class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::ipList(\dash\db\login\get::get_count_all_group_by_ip());


	}
}
?>