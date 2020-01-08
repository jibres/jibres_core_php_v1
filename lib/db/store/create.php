<?php
namespace lib\db\store;


class create
{
	public static function database_customer($_fuel, $_customer_database)
	{
		$query = "CREATE DATABASE IF NOT EXISTS `$_customer_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;";
		$result = \dash\db::query($query, $_fuel, ['database' => 'mysql']);
		return $result;
	}

}
?>