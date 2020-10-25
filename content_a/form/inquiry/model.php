<?php
namespace content_a\form\inquiry;

class model
{
	public static function post()
	{
		$form_id = \dash\request::get('id');

		$post =
		[
			'inquiry_mode' => 1,
			'inquiry'      => \dash\request::post('inquiry'),
			'inquirymsg'   => \dash\request::post('inquirymsg'),
			'showcomment'  => \dash\request::post('showcomment'),
			'showpulictag' => \dash\request::post('showpulictag'),
			'question'     => \dash\request::post('question'),
		];

		$result = \lib\app\form\form\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>