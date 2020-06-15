<?php
namespace content_b1\product\comment\add;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');

		$update =
		[
			'content' => \dash\request::post('content'),
			'status'  => \dash\request::post('status'),
		];

		$result = \lib\app\product\comment::edit($update, $id);

		\content_b1\tools::say($result);

	}


}
?>