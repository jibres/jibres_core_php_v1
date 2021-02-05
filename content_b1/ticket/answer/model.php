<?php
namespace content_b1\ticket\answer;


class model
{
	public static function post()
	{

		$args =
		[
			'content'     => \dash\request::input_body('content'),
			'sendmessage' => \dash\request::input_body('sendmessage'),
			'note'        => \dash\request::input_body('note'),
		];

		$result = \dash\app\ticket\answer::add($args, \dash\request::get('id'));

		\content_b1\tools::say($result);

	}

}
?>