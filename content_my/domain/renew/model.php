<?php
namespace content_my\domain\renew;


class model
{
	public static function post()
	{

		$post =
		[
			'domain' => \dash\request::post('domain'),
			'period' => \dash\request::post('period'),
		];


		$result = \lib\app\nic_domain\renew::renew($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>