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
	}
}
?>