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
			'user_id' => \dash\request::get('id'),
			'type'    => 'plus',
		];

		$result = \dash\app\transaction\plus_minus::set($args);

		\content_b1\tools::say($result);
	}
}
?>