<?php
namespace content_domain\buy;


class model
{
	public static function post()
	{
		$post =
		[
			'domain' => \dash\data::myDomain(),
			'irnic'  => \dash\request::post('irnic'),
			'period' => \dash\request::post('period'),
			'ns1'    => \dash\request::post('ns1'),
			'ns2'    => \dash\request::post('ns2'),
			'ns3'    => \dash\request::post('ns3'),
			'ns4'    => \dash\request::post('ns4'),
		];

		if(!\dash\request::post('agree'))
		{
			\dash\notif::warn(T_("Please view the privacy polici and check 'I agree' check box"), 'agree');
			return false;
		}

		$result = \lib\app\nic_domain\create::new_domain($post);

	}
}
?>