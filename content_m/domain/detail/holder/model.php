<?php
namespace content_m\domain\detail\holder;


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

		$result = \lib\app\nic_domain\edit::domain($post, \dash\data::domainDetail_id(), 'holder');

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::pwd());
		}
	}
}
?>