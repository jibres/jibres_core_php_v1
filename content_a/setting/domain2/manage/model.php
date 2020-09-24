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

			$result = \lib\app\business_domain\dns::add(\dash\data::dataRow_id(), $post);
		}


		if(\dash\request::post('removedns') === 'removedns')
		{
			$result = \lib\app\business_domain\dns::remove(\dash\data::dataRow_id(), \dash\request::post('dnsid'));
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}


}
?>