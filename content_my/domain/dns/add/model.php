<?php
namespace content_my\domain\dns\add;


class model
{
	public static function post()
	{
		$post =
		[
			'title'     => \dash\request::post('title'),
			'ns1'       => \dash\request::post('ns1'),
			'ns2'       => \dash\request::post('ns2'),
			'ip1'       => \dash\request::post('ip1'),
			'ip2'       => \dash\request::post('ip2'),
			'ns3'       => \dash\request::post('ns3'),
			'ns4'       => \dash\request::post('ns4'),
			'ip3'       => \dash\request::post('ip3'),
			'ip4'       => \dash\request::post('ip4'),
			'isdefault' => \dash\request::post('isdefault'),
		];

		if(\dash\url::isLocal())
		{
			$get_api    = new \lib\nic\api();
			$create       = $get_api->dns_create($post);
		}
		else
		{
			$create = \lib\app\nic_dns\add::new_record($post);
		}

		if($create && \dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that());
		}

	}
}
?>