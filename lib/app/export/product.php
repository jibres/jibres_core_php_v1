<?php
namespace lib\app\export;

class product
{

	public static function run($_detail = [])
	{

		$start_limit  = 0;
		$end_limit    = 1000;

		$result       = \lib\db\products\get::export_list($start_limit, $end_limit);
		$first_record = true;

		$file_name = 'Export_Product_'. date("Y_m_d"). '_'. rand(11111, 99999);

		$addr = \lib\app\export\directory::product($file_name);

		while ($result)
		{
			$result       = array_map(['\\lib\\app\\product\\ready', 'export'], $result);

			\dash\utility\export::csv_file(['name' => $file_name, 'data' => $result], $addr, $first_record);

			$limit        = $start_limit + 1000;
			$start_limit  = $limit;

			$first_record = false;
			$end_limit    = $end_limit + 1000;

			$result       = \lib\db\products\get::export_list($start_limit, $end_limit);

		}

		$msg = T_("Create export products completed");
		$msg .= '<br>'. T_("This file will be automatically deleted tomorrow");

		$myname = T_("Products");
		$user_id = isset($_detail['creator']) ? $_detail['creator']: null;

		if($user_id)
		{
			\dash\log::set('export_ExportProduct', ['fileaddr' => $addr, 'myname' => $myname, 'to' => $user_id]);
		}

		return $addr;

	}
}
?>