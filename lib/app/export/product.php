<?php
namespace lib\app\export;

class product
{

	public static function run($_detail = [])
	{

		ini_set('max_execution_time', 300); //300 seconds = 5 minutes
		set_time_limit(300);

		$start_limit = 0;
		$step        = 1000;
		$end_limit   = $step;

		$result       = \lib\db\products\get::export_list($start_limit, $end_limit);

		$first_record = true;

		$file_name    = 'export-products-'. date("Y-m-d"). '-'. date("His"). '-'. rand(11111,99999);

		$addr         = \lib\app\export\directory::temp_dir('products');

		while ($result)
		{
			$result       = array_map(['\\lib\\app\\product\\ready', 'export'], $result);

			\dash\utility\export::csv_file(['name' => $file_name, 'data' => $result], $addr, $first_record);

			$limit        = $start_limit + $step;
			$start_limit  = $limit;

			$first_record = false;
			$end_limit    = $end_limit + $step;

			$result       = \lib\db\products\get::export_list($start_limit, $step);

		}


		$file_detail         = \dash\upload\importexport::push_export_file($addr, $file_name, 'products');

		$path = null;
		if(isset($file_detail['path']))
		{
			$path = $file_detail['path'];
		}

		$msg = T_("Create export products completed");
		$msg .= '<br>'. T_("This file will be automatically deleted tomorrow");

		$myname = T_("Products");
		$user_id = isset($_detail['creator']) ? \dash\validate::id($_detail['creator'], false): null;

		if($user_id)
		{
			\dash\log::set('export_ExportProduct', ['fileaddr' => $path, 'myname' => $myname, 'to' => $user_id]);
		}

		return $path;

	}
}
?>