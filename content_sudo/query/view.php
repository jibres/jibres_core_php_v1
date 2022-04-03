<?php
namespace content_sudo\query;


class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::ipList(\dash\db\login\get::get_count_all_group_by_ip());

		$a1 = \dash\pdo\sys_query::show_glogal('table_definition_cache');
		$a2 = \dash\pdo\sys_query::timeout_setting();
		$a3 = \dash\pdo\sys_query::show_status('open_table');
		$a4 = \dash\pdo::get(" show status where `variable_name` = 'Threads_connected';");

		\dash\data::mysqlConf(array_merge($a1, $a2, $a3, $a4));




		\dash\data::showDatabases_501(\dash\pdo\sys_query::show_databases('501'));
		\dash\data::showDatabases_400(\dash\pdo\sys_query::show_databases('400'));
		\dash\data::showDatabases_101(\dash\pdo\sys_query::show_databases('jibres101'));

		$all_connection = \dash\pdo\connection::link_open();
		\dash\data::allConnection($all_connection);


	}
}
?>