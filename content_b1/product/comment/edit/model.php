<?php
namespace content_b1\product\comment\edit;


class model
{
	public static function patch()
	{
		$id = \dash\request::get('id');

		$update =
		[
			'content' => \content_b1\tools::input_body('content'),
			'status'  => \content_b1\tools::input_body('status'),
		];

		$result = \lib\app\product\comment::edit($update, $id);

		\content_b1\tools::say($result);

	}


}
?>