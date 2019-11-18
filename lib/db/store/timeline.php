<?php
namespace lib\db\store;


class timeline
{


	public static function insert($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `store_timeline` SET $set ";

			if(\dash\db::query($query))
			{
				$id = \dash\db::insert_id();
				return $id;
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

	public static function update($_args, $_id)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'update']);
		if($set)
		{
			$query = " UPDATE `store_timeline` SET $set WHERE store_timeline.id = $_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
		else
		{
			return false;
		}
	}

	public static function set_store_id($_id, $_store_id)
	{
		$query = " UPDATE `store_timeline` SET store_timeline.store_id = $_store_id WHERE store_timeline.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function update_by_store_id($_args, $_store_id)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'update']);
		if($set)
		{
			$query = " UPDATE `store_timeline` SET $set WHERE store_timeline.store_id = $_store_id LIMIT 1";
			$result = \dash\db::query($query);
			return $result;
		}
		else
		{
			return false;
		}
	}

	public static function get_by_store_id($_store_id)
	{
		$query = "SELECT * FROM `store_timeline`WHERE store_timeline.store_id = $_store_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}





}
?>