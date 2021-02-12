<?php
namespace content_r10\domain\renew;


class model
{
	public static function post()
	{
		$post =
		[
			'domain'      => \dash\request::input_body('domain'),
			'period'      => \dash\request::input_body('period'),
			'agree'       => \dash\request::input_body('agree'),
			'register_now' => true,
		];

		$result = \lib\app\domains\renew::renew($post);

		\content_r10\tools::say($result);
	}
}
?>