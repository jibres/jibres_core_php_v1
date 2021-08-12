<?php
namespace dash\app\user;

class export
{

	public static function count_all()
	{
		$count_user_available = \dash\db\users\get::count_all();
		return intval($count_user_available);
	}


	public static function download_now()
	{
		$count_all = self::count_all();

		if($count_all > 50)
		{
			\dash\redirect::to(\dash\url::that());
		}
		else
		{
			$list = \dash\db\users\get::all_record_for_export();
			$list = array_map(['\\dash\\app\\user', 'ready'], $list);
			$list = array_map(['\\dash\\app\\user', 'ready_api'], $list);
			\dash\utility\export::csv(['name' => 'export-users-'.date("Y-m-d"). '-'. date("His"). '-'. $count_all, 'data' => $list]);
			return;
		}
	}



	public static function queue()
	{
		$count_all = self::count_all();
		if(!$count_all)
		{
			\dash\notif::info(T_("You have not any user to export"));
			return;
		}

		return \lib\app\export\add::request('users');

	}


	public static function list()
	{
		$get_by_type = \lib\db\export\get::by_type('users');
		$get_by_type = array_map(['\\lib\\app\\export\\ready', 'row'], $get_by_type);
		return $get_by_type;
	}
}
?>