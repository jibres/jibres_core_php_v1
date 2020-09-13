<?php
namespace content_love\business\domain\add;


class model
{
	public static function post()
	{


		$post =
		[
			'domain' => \dash\request::post('domain'),
		];

		$result = \lib\app\business_domain\add::add($post);

		if(isset($result['id']))
		{
			\dash\redirect::to(\dash\url::that(). '/detail?id='. $result['id']);
		}

	}
}
?>