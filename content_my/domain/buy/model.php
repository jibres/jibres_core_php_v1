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

			if(!\dash\validate::domain($domain))
			{
				\dash\notif::error(T_("Please enter a valid domain"), 'domain');
				return false;
			}

			$url = \dash\url::this(). '/buy/'. $domain;

			\dash\redirect::to($url);
		}


		$post =
		[
			'domain'      => \dash\data::myDomain(),
			'nic_id'      => \dash\request::post('irnicid'),
			'period'      => \dash\request::post('period'),
			'irnic_new'   => \dash\request::post('irnicid-new'),
			'irnic_admin' => \dash\request::post('irnic_admin'),
			'irnic_tech'  => \dash\request::post('irnic_tech'),
			'irnic_bill'  => \dash\request::post('irnic_bill'),
			'ns1'         => \dash\request::post('ns1'),
			'ns2'         => \dash\request::post('ns2'),
			'ns3'         => \dash\request::post('ns3'),
			'ns4'         => \dash\request::post('ns4'),
			'dnsid'       => \dash\request::post('dnsid'),
			'agree'       => \dash\request::post('agree'),
		];


		if(\lib\nic\mode::api())
		{
			$get_api = new \lib\nic\api();
			$result  = $get_api->domain_buy($post);
		}
		else
		{
			$result = \lib\app\nic_domain\create::new_domain($post);
		}

		if(\dash\engine\process::status() && isset($result['domain_id']))
		{
			\dash\redirect::to(\dash\url::this(). '/review?type=register&id='. $result['domain_id']);
		}


		if(\dash\engine\process::status())
		{
			if(\dash\temp::get('need_show_domain_result') && \dash\temp::get('domain_code_url'))
			{
				\dash\redirect::to(\dash\url::this(). '/?resultid='. \dash\temp::get('domain_code_url'));
			}
			else
			{
				\dash\redirect::to(\dash\url::this());
			}
		}
	}
}
?>