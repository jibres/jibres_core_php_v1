<?php
namespace lib\db\files;


class usage
{
	public static function remove($_related, $_related_id, $_file_id)
	{
		$query = "DELETE FROM fileusage WHERE fileusage.file_id = $_file_id AND fileusage.related = '$_related' AND fileusage.related_id = $_related_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

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


}

?>