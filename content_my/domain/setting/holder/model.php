<?php
namespace content_my\domain\setting\holder;


class model
{
	public static function post()
	{
		$post =
		[
			// 'holder' => \dash\request::post('holder'),
			// 'admin' => \dash\request::post('admin'),
			'tech'  => \dash\request::post('tech'),
			'bill'  => \dash\request::post('bill'),
		];

		if(\lib\nic\mode::api())
		{
			$get_api     = new \lib\nic\api();
			$load_domain = $get_api->domain_update_holder(\dash\data::domainDetail_id(), $post);
		}
		else
		{
			$result = \lib\app\nic_domain\edit::domain($post, \dash\data::domainDetail_id(), 'holder');
		}


		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::pwd());
		}
	}
}
?>