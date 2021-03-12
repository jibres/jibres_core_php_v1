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
		];

		if(\dash\request::post('jibresdns') === 'jibresdns')
		{
			$post['ns1'] = \lib\app\nic_usersetting\defaultval::ns1();
			$post['ns2'] = \lib\app\nic_usersetting\defaultval::ns2();
		}

		// $result = \lib\app\nic_domain\edit::domain($post, \dash\data::domainDetail_id(), 'dns');
		$result = \lib\app\domains\edit::dns($post, \dash\data::domainDetail_id());

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::pwd());
		}
	}
}
?>