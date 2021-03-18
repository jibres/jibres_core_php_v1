<?php
namespace content_su\dnsprovider;

class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::kingdom());

		$old_ip = \dash\request::get('oldip');

		$old_ip = '45.82.139.124';

		$old_ip = \dash\validate::ip($old_ip);
		if($old_ip)
		{

			$old_ip = ['ip' => $old_ip, 'count' => \lib\db\business_domain\get::count_dns_by_value($old_ip)];

			\dash\data::myOldIp($old_ip);
		}
	}
}
?>