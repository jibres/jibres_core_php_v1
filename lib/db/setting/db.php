<?php
namespace lib\db\setting;


class db
{
	public static function insert($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `setting` SET $set ";

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


	public static function update($_cat, $_key, $_value)
	{
		$query = "UPDATE setting SET setting.value = '$_value'  WHERE setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}


	public static function get($_cat, $_key)
	{
		$query = "SELECT * FROM setting WHERE setting.cat = '$_cat' AND setting.key = '$_key' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function get_cat($_cat)
	{
		$query = "SELECT * FROM setting WHERE setting.cat = '$_cat'";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>