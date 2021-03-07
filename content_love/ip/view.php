<?php
namespace content_love\ip;


class view
{
	public static function config()
	{
		\dash\face::title(T_("IP"));
		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());


		$count_file = \dash\waf\ip::countFileInFolder();
		\dash\data::countFile($count_file);

		$ip = \dash\request::get('ip');
		if($ip)
		{
			$ip = \dash\validate::ip($ip);

			if($ip)
			{
				\dash\data::myIP($ip);

				$ipDetail = \dash\waf\ip::open_ip_file($ip);
				\dash\data::ipDetail($ipDetail);

				if($ip && !$ipDetail)
				{
					\dash\data::ipNotFound(true);
				}
			}
		}

		if(\dash\request::get('download') === 'download' && \dash\data::ipDetail())
		{
			\dash\code::jsonBoom(\dash\data::ipDetail());
		}

		$folder = \dash\request::get('folder');
		if($folder)
		{
			if(isset($count_file[$folder]) && is_numeric($count_file[$folder]) && floatval($count_file[$folder]) <= 100)
			{
				$list = \dash\waf\ip::load_folder($folder);
				if(is_array($list))
				{
					\dash\data::folderList($list);
				}
			}
			else
			{
				\dash\notif::error(T_("Can not open this folder!"));
			}
		}
	}
}
?>