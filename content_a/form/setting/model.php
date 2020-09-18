<?php
namespace content_a\form\setting;

class model
{
	public static function post()
	{
		$form_id = \dash\request::get('id');


		$post =
		[
			'title'      => \dash\request::post('title'),
			'slug'       => \dash\request::post('slug'),
			'status'     => \dash\request::post('status'),
			'desc'       => \dash\request::post('desc') ? $_POST['desc'] : null,
			'endmessage' => \dash\request::post('endmessage'),
			'redirect'   => \dash\request::post('redirect'),

		];

		if(\dash\request::files('file'))
		{
			$post['file']   = \dash\upload\form::form($form_id);
		}

		$result = \lib\app\form\form\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>