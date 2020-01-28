<?php
namespace lib\app\import;

class product
{
	public static function pre_check($_detail)
	{
		$file = isset($_detail['file']) ? $_detail['file'] : null;
		$meta = isset($_detail['meta']) ? $_detail['meta'] : null;

		if(!$file)
		{
			\dash\notif::error(T_("File not found"));
			return false;
		}

		if(!is_file($file))
		{
			\dash\notif::error(T_("File not found"));
			return false;
		}

		if(filesize($file) > (6*1024*1024))
		{
			\dash\notif::error(T_("File size error"));
			return false;
		}

		$load = \dash\utility\import::csv($file, 1001);
		if(!$load || !is_array($load))
		{
			\dash\notif::error(T_("Can not read file"));
			return false;
		}

		if(count($load) > 1000)
		{
			\dash\notif::error(T_("Only 1,000 products are accepted in each file"));
			return false;
		}


	}
}
?>