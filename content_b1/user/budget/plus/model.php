<?php
namespace content_b1\user\budget\plus;


class model
{
	public static function post()
	{

		$args =
		[
			'title'   => \dash\request::input_body('title'),
			'amount'  => \dash\request::input_body('amount'),
			'user_code' => \dash\request::get('id'),
		];

		$result = \dash\app\transaction\budget::plus($args);

		\content_b1\tools::say($result);
	}
}
?>