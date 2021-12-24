<?php
namespace lib\db\store;


class insert
{
	public static function store($_args)
	{
		return \dash\pdo\query_template::insert('store', $_args);
	}


	public static function store_data($_args)
	{
		return \dash\pdo\query_template::insert('store_data', $_args);
	}


	public static function store_plan($_args)
	{
		return \dash\pdo\query_template::insert('store_plan', $_args);
	}


	public static function store_user($_args)
	{
		return \dash\pdo\query_template::insert('store_user', $_args);
	}


	public static function store_analytics($_args)
	{
		return \dash\pdo\query_template::insert('store_analytics', $_args);
	}


	public static function store_timeline($_args)
	{
		return \dash\pdo\query_template::insert('store_timeline', $_args);
	}
}
?>