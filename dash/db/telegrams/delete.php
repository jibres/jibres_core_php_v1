<?php
namespace dash\db\telegrams;


class delete
{

	public static function record($_id)
	{
		$query  = "DELETE FROM telegrams WHERE telegrams.id = $_id ";
		$result = \dash\pdo::query($query, []);
		return $result;
	}


	/**
	 * Delete sending list
	 */
	public static function sending_by_multi_id($_ids)
	{
		$query  = "DELETE FROM telegram_sending WHERE telegram_sending.id IN ($_ids)";
		$result = \dash\pdo::query($query, [], 'api_log');
		return $result;
	}






}
?>
