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

		$result = \lib\app\nic_domain\edit::domain($post, \dash\data::domainDetail_id());

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::pwd());
		}
	}
}
?>