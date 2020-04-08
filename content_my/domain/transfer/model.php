<?php
namespace content_my\domain\transfer;


class model
{
	public static function post()
	{
		$post =
		[
			'domain'    => \dash\request::post('domain'),
			'nic_id'    => \dash\request::post('irnicid'),
			'irnic_new' => \dash\request::post('irnicid-new'),
			'pin'       => \dash\request::post('pin'),
			'agree'     => \dash\request::post('agree'),
		];

		if(\lib\nic\mode::api())
		{
			$get_api = new \lib\nic\api();
			$result  = $get_api->domain_transfer($post);
		}
		else
		{
			$result = \lib\app\nic_domain\transfer::transfer($post);
		}



		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>