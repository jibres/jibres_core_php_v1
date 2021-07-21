<?php
namespace content_su\dnsprovider;

class model
{
	public static function post()
	{
		\lib\app\business_domain\dns::force_update_all_dns();

	}
}
?>