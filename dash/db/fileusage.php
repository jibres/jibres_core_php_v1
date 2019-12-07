<?php
namespace dash\db;


class fileusage
{

	public static function insert($_args)
	{
		$set = \dash\db\config::make_set($_args, ['type' => 'insert']);
		if($set)
		{
			$query = " INSERT INTO `fileusage` SET $set ";

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

	/**
	 * check duplocate MD5 of file in database
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function remove_usage($_related, $_related_id)
	{
		$query = "DELETE FROM fileusage WHERE fileusage.related = '$_related' AND fileusage.related_id = '$_related_id' LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function duplicate($_related, $_related_id)
	{
		$query = "SELECT * FROM fileusage WHERE fileusage.related = '$_related' AND fileusage.related_id = '$_related_id' LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function update_file_id($_fileusage_id, $_new_file_id)
	{
		$query = "UPDATE fileusage SET fileusage.file_id = $_new_file_id WHERE fileusage.id = $_fileusage_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>