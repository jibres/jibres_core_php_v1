<?php
namespace content_a\customer\export;


class model
{

	public static function post()
	{
		$export_type = \dash\request::post('export');
		if(!in_array($export_type, ['staff', 'supplier', 'customer', 'customer']))
		{
			\dash\notif::error(T_("Dont!"));
			return false;
		}

		$link = \lib\app\customer\export::csv($export_type);
		if($link)
		{
			$msg = T_("Create export file completed");
			$msg .= '<a href="'. $link. '" download > <b>'. T_("To download it click here"). '</b> </a>';
			$msg .= '<br>'. T_("This file will be automatically deleted for a few minutes");
			\dash\notif::ok($msg, ['timeout' => 999999]);
		}

	}
}
?>

