<?php
namespace content_a\form\duplicate;

class model
{
	public static function post()
	{
		$form_id = \dash\request::get('id');


		$post =
		[
			'title'      => \dash\request::post('title'),
		];

		$result = \lib\app\form\form\add::duplicate($post, $form_id);

		if(\dash\engine\process::status() && isset($result['id']))
		{
			\dash\redirect::to(\dash\url::this(). '/edit?id='. $result['id']);
		}

	}
}
?>