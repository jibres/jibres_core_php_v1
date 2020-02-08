<?php
namespace content_domain\dns\add;


class model
{
	public static function post()
	{
		$post =
		[
			'title' => \dash\request::post('title'),
			'ns1'   => \dash\request::post('ns1'),
			'ns2'   => \dash\request::post('ns2'),
			'ip1'   => \dash\request::post('ip1'),
			'ip2'   => \dash\request::post('ip2'),
			'ns3'   => \dash\request::post('ns3'),
			'ns4'   => \dash\request::post('ns4'),
			'ip3'   => \dash\request::post('ip3'),
			'ip4'   => \dash\request::post('ip4'),
		];

		$create = \lib\app\nic_dns\add::new_record($post);

		if($create)
		{
			\dash\redirect::to(\dash\url::this());
		}



	}
}
?>