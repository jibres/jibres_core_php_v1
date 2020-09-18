<?php
namespace content_a\form\thankyou;

class model
{
	public static function post()
	{
		$form_id = \dash\request::get('id');

		$post =
		[

			'endmessage' => \dash\request::post('endmessage'),
			'redirect'   => \dash\request::post('redirect'),

		];

		$result = \lib\app\form\form\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>