<?php
namespace content_my\domain\buy;


class model
{
	public static function post()
	{
		$domain = \dash\request::post('domain');

		if($domain && \dash\request::post('whois'))
		{
			if(!$domain)
			{
				\dash\redirect::to(\dash\url::this());
			}

			if(!\lib\app\nic_domain\check::syntax($domain))
			{
				\dash\notif::error(T_("Please enter a valid domain"), 'domain');
				return false;
			}

			$url = \dash\url::this(). '/buy/'. $domain;

			\dash\redirect::to($url);
		}


		$post =
		[
			'domain' => \dash\data::myDomain(),
			'nic_id' => \dash\request::get('irnicid'),
			'period' => \dash\request::get('period'),
			'ns1'    => \dash\request::post('ns1'),
			'ns2'    => \dash\request::post('ns2'),
			'ns3'    => \dash\request::post('ns3'),
			'ns4'    => \dash\request::post('ns4'),
			'dnsid'  => \dash\request::post('dnsid'),
			'pay'    => 'auto',
		];

		if(!\dash\request::post('agree'))
		{
			\dash\notif::warn(T_("Please view the privacy policy and check 'I agree' check box"), 'agree');
			return false;
		}

		$result = \lib\app\nic_domain\create::new_domain($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>