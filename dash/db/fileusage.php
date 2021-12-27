<?php
namespace dash\db;


/**
 * This class describes an fileusage.
 *
 * @author Reza
 *
 * All functions in this class became query bind PDO
 * @date 2021-12-27 15:37:41
 *
 */
class fileusage
{

	public static function insert($_args)
	{
		return \dash\pdo\query_template::insert('fileusage', $_args);
	}

	/**
	 * check duplocate MD5 of file in database
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function remove_usage($_related, $_related_id)
	{
		$query = "DELETE FROM fileusage WHERE fileusage.related = :related AND fileusage.related_id = :related_id LIMIT 1";
		$param = [':related' => $_related, ':related_id' => $_related_id];
		$result = \dash\pdo::query($query, $param);
		return $result;
	}


	public static function remove_usage_file_id($_related, $_related_id, $_file_id)
	{
		$query = "DELETE FROM fileusage WHERE fileusage.related = :related AND fileusage.related_id = :related_id AND fileusage.file_id = :file_id LIMIT 1";
		$param = [':related' => $_related, ':related_id' => $_related_id, ':file_id' => $_file_id];
		$result = \dash\pdo::query($query, $param);
		return $result;
	}


	public static function duplicate_whit_file_id($_related, $_related_id, $_file_id)
	{
		$query = "SELECT * FROM fileusage WHERE fileusage.related = :related AND fileusage.related_id = :related_id AND fileusage.file_id = :file_id LIMIT 1";
		$param = [':related' => $_related, ':related_id' => $_related_id, ':file_id' => $_file_id];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}

	public static function duplicate($_related, $_related_id)
	{
		$query = "SELECT * FROM fileusage WHERE fileusage.related = :related AND fileusage.related_id = :related_id LIMIT 1";
		$param = [':related' => $_related, ':related_id' => $_related_id];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}


	public static function update_file_id($_fileusage_id, $_new_file_id)
	{
		$query = "UPDATE fileusage SET fileusage.file_id = :new_file_id WHERE fileusage.id = :fileusage_id LIMIT 1";
		$param = [':new_file_id' => $_new_file_id, ':fileusage_id' => $_fileusage_id];
		$result = \dash\pdo::query($query, $param);
		return $result;
	}
}
?>