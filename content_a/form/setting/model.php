<?php
namespace content_a\form\setting;

class model
{

	public static function post()
	{
		$form_id = \dash\request::get('id');


		$post =
			[
				'title'        => \dash\request::post('title'),
				'slug'         => \dash\request::post('slug'),
				'desc'         => \dash\request::post('desc'),
				'saveasticket' => \dash\request::post('saveasticket'),
				'answerlimit'  => \dash\request::post('answerlimit'),
				'reportpage'   => \dash\request::post_html(),

			];

		if(\dash\request::files('file'))
		{
			$post['file'] = \dash\upload\form::form($form_id);
		}

		$result = \lib\app\form\form\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}

}

?>