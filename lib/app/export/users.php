<?php
namespace lib\app\export;

class users
{

	public static function run($_detail = [])
	{

		ini_set('max_execution_time', 10000); //300 seconds = 5 minutes
		\dash\code::time_limit(0);

		$start_limit = 0;
		$step        = 1000;
		$end_limit   = $step;

		$result       = \dash\db\users\get::export_list($start_limit, $end_limit);

		$first_record = true;

		$file_name    = 'export-users-'. date("Y-m-d"). '-'. date("His"). '-'. rand(11111,99999);

		$addr         = \lib\app\export\directory::temp_dir('users');

		while ($result)
		{
			$result       = array_map(['\\dash\\app\\user', 'ready'], $result);
			$result       = array_map(['\\dash\\app\\user', 'ready_api'], $result);

			\dash\utility\export::csv_file(['name' => $file_name, 'data' => $result], $addr, $first_record);

			$limit        = $start_limit + $step;
			$start_limit  = $limit;

			$first_record = false;
			$end_limit    = $end_limit + $step;

			$result       = \dash\db\users\get::export_list($start_limit, $step);

		}


		$file_detail         = \dash\upload\importexport::push_export_file($addr, $file_name, 'users');

		// \dash\log::debug_line(__LINE__, $file_detail);

		$path = null;
		if(isset($file_detail['path']))
		{
			$path = $file_detail['path'];
		}

		\dash\file::delete($addr);

		$msg = T_("Create export users completed");
		$msg .= '<br>'. T_("This file will be automatically deleted tomorrow");

		$myname = T_("Users");
		$user_id = isset($_detail['creator']) ? \dash\validate::id($_detail['creator'], false): null;

		if($user_id)
		{
			\dash\log::set('export_ExportUser', ['fileaddr' => $path, 'myname' => $myname, 'to' => $user_id]);
		}

		return $path;

	}
}
?>