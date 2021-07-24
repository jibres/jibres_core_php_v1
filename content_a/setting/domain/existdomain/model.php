<?php
namespace content_a\setting\domain\existdomain;


class model
{
	public static function post()
	{
		$post =
		[
			'domain' => \dash\request::post('domain'),
		];

		$result = \lib\app\business_domain\add::store_add($post);

		if(\dash\engine\process::status() && isset($result['domain']))
		{
			\dash\redirect::to(\dash\url::that(). '/manage?domain='. $result['domain']);
		}
	}


}
?>