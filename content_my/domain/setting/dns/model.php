<?php
namespace content_my\domain\setting\dns;


class model
{
	public static function post()
	{

		$post =
		[
			'ns1'   => \dash\request::post('ns1'),
			'ns2'   => \dash\request::post('ns2'),
			'ns3'   => \dash\request::post('ns3'),
			'ns4'   => \dash\request::post('ns4'),

			'ip1'   => \dash\request::post('ip1'),
			'ip2'   => \dash\request::post('ip2'),
			'ip3'   => \dash\request::post('ip3'),
			'ip4'   => \dash\request::post('ip4'),
		];

		if(\lib\nic\mode::api())
		{
			$get_api     = new \lib\nic\api();
			$load_domain = $get_api->domain_update_dns(\dash\data::domainDetail_id(), $post);
		}
		else
		{
			// $result = \lib\app\nic_domain\edit::domain($post, \dash\data::domainDetail_id(), 'dns');
			$result = \lib\app\domains\edit::dns($post, \dash\data::domainDetail_id());
		}


		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::pwd());
		}
	}
}
?>