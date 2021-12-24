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
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `store_data` SET $set ";

			if(\dash\pdo::query($query, []))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}


	public static function store_plan($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `store_plan` SET $set ";

			if(\dash\pdo::query($query, []))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}


	public static function store_user($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `store_user` SET $set ";

			if(\dash\pdo::query($query, []))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}


	public static function store_analytics($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `store_analytics` SET $set ";

			if(\dash\pdo::query($query, []))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}


	public static function store_timeline($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `store_timeline` SET $set ";

			if(\dash\pdo::query($query, []))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}
?>