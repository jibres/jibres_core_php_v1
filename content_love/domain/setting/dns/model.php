<?php
namespace content_love\domain\setting\dns;


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

		if(\dash\request::post('raw_edit') === 'raw_edit')
		{
			$result = \lib\app\nic_domain\edit::domain($post, \dash\data::domainDetail_id(), 'dns', true, true);
		}
		else
		{
			$result = \lib\app\nic_domain\edit::domain($post, \dash\data::domainDetail_id(), 'dns', false, true);
		}


		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::pwd());
		}
	}
}
?>