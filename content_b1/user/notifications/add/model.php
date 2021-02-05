<?php
namespace content_b1\user\notifications\add;


class model
{
	public static function post()
	{
		$args         = [];
		$args['user'] = \dash\request::get('userid');
		$args['text'] = \dash\request::input_body('text');

		$result = \dash\app\log\add::notif_once($args);

		\content_b1\tools::say($result);
	}
}
?>