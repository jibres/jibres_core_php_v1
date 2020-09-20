<?php
namespace content_a\form\analytics\duplicate;

class model
{
	public static function post()
	{
		$form_id = \dash\request::get('id');


		$post =
		[
			'title'      => \dash\request::post('title'),
		];

		$result = \lib\app\form\filter\add::duplicate($post, $form_id, \dash\request::get('fid'));

		if(\dash\engine\process::status() && isset($result['id']))
		{
			\dash\redirect::to(\dash\url::that(). '/filter?fid='. $result['id']. '&id='. \dash\request::get('id'));
		}

	}
}
?>