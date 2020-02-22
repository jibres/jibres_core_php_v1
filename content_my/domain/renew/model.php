<?php
namespace content_my\domain\renew;


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

			$url = \dash\url::this(). '/renew/'. $domain;

			\dash\redirect::to($url);
		}


		$post =
		[
			'domain' => \dash\request::post('domain'),
			'nic_id' => \dash\request::post('irnicid'),
			'period' => \dash\request::post('period'),
			'pay'    => \dash\request::post('pay'),
		];

		if(!\dash\request::post('agree'))
		{
			\dash\notif::warn(T_("Please view the privacy policy and check 'I agree' check box"), 'agree');
			return false;
		}

		$result = \lib\app\nic_domain\renew::renew($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>