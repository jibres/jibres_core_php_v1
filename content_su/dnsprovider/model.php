<?php
namespace content_su\dnsprovider;

class model
{
	public static function post()
	{
		if(\dash\request::post('ssl') === 'ssl')
		{
			\lib\app\business_domain\https::force_update_all_https();
		}
		// $old_ip = \dash\request::get('oldip');
		// $old_ip = '45.82.139.124';
		// $old_ip = \dash\validate::ip($old_ip);

		// $new_ip = \dash\request::post('newip');
		// $new_ip = '185.208.180.130';
		// $new_ip = \dash\validate::ip($new_ip);

		// if(!$old_ip || !$new_ip)
		// {
		// 	\dash\notif::error(T_("New ip is required"));
		// 	return false;
		// }

		// if($old_ip == $new_ip)
		// {
		// 	\dash\notif::error(T_("Old ip and new ip is required"));
		// 	return false;
		// }


		// \lib\app\business_domain\dns::force_update_all_dns($old_ip, $new_ip);




	}
}
?>