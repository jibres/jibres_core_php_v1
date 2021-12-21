<?php
namespace lib\db\store_app;


class get
{

	public static function jibres_my_app_detail($_store_id)
	{
		$query  = "SELECT * FROM store_app WHERE  store_app.store_id = $_store_id ORDER BY store_app.id DESC LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true, 'master');
		return $result;
	}


	public static function build_queue()
	{
		$query  = "SELECT * FROM store_app WHERE  store_app.status IN ('queue', 'inprogress') ORDER BY store_app.id ASC LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true, 'master');
		return $result;
	}


	public static function by_id($_id)
	{
		$query  = "SELECT * FROM store_app WHERE  store_app.id = $_id LIMIT 1";
		$result = \dash\pdo::get($query, [], null, true, 'master');
		return $result;
	}



	public static function count_record_store($_store_id)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM store_app WHERE store_app.store_id = $_store_id ";
		$result = \dash\pdo::get($query, [], 'count', true, 'master');
		return $result;
	}


	public static function group_by_status()
	{
		$query  = "SELECT COUNT(*) AS `count`, store_app.status FROM store_app GROUP BY store_app.status ";
		$result = \dash\pdo::get($query);
		return $result;
	}


}
?>
