<?php
namespace content_a\setting\domain2\manage;


class model
{
	public static function post()
	{
		if(\dash\request::post('adddns') === 'adddns')
		{
			$post =
			[
				'type'             => \dash\request::post('type'),
				'key'              => \dash\request::post('key'),
				'value'            => \dash\request::post('value'),
				'addtocdnpaneldns' => \dash\request::post('addtocdnpaneldns'),
			];

			$result = \lib\app\business_domain\dns::add(\dash\data::domainID(), $post);
		}


		if(\dash\request::post('removedns') === 'removedns')
		{
			$result = \lib\app\business_domain\dns::remove(\dash\data::domainID(), \dash\request::post('dnsid'));
		}


		if(\dash\request::post('jibresdns') === 'jibresdns')
		{
			$result = \lib\app\business_domain\dns::jibres_dns(\dash\data::domainID());
		}


		if(\dash\request::post('dnsfetch') === 'dnsfetch')
		{
			$result = \lib\app\business_domain\dns::fetch(\dash\data::domainID());
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}


}
?>