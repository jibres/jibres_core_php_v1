<?php
namespace content_sudo\query;


class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::ipList(\dash\db\login\get::get_count_all_group_by_ip());

		$a1 = \dash\db\mysql\tools\info::show_glogal('table_definition_cache');
		$a2 = \dash\db\mysql\tools\info::timeout_setting();

		\dash\data::mysqlConf(array_merge($a1, $a2));




		\dash\data::showDatabases_501(\dash\db\mysql\tools\info::show_databases('501'));
		\dash\data::showDatabases_400(\dash\db\mysql\tools\info::show_databases('400'));
		\dash\data::showDatabases_101(\dash\db\mysql\tools\info::show_databases('jibres101'));

		$all_connection = \dash\db\mysql\tools\connection::link_open();
		\dash\data::allConnection($all_connection);


	}
}
?>