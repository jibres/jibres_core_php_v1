<?php
namespace content_domain\setting;


class model
{
	public static function post()
	{
		$post =
		[
			'domain' => \dash\request::post('domain'),
			'nic_id'  => \dash\request::post('irnicid'),
			'period' => \dash\request::post('period'),
			'ns1'    => \dash\request::post('ns1'),
			'ns2'    => \dash\request::post('ns2'),
			'ns3'    => \dash\request::post('ns3'),
			'ns4'    => \dash\request::post('ns4'),
			'dnsid'  => \dash\request::post('dnsid'),
		];

		if(!\dash\request::post('agree'))
		{
			\dash\notif::warn(T_("Please view the privacy polici and check 'I agree' check box"), 'agree');
			return false;
		}

		$result = \lib\app\nic_domain\create::new_domain($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::here());
		}
	}
}
?>