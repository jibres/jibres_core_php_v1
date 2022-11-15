<?php

namespace content_a\form\resultpage;

class model
{

	public static function post()
	{
		$form_id = \dash\request::get('id');

		$post =
			[
				'resultpage_mode'        => 1,
				'resultpage'             => \dash\request::post('resultpage'),
				'showtotalamount'        => \dash\request::post('showtotalamount'),
				'showsuccessfullpayment' => \dash\request::post('showsuccessfullpayment'),
				'resultpagetext'         => \dash\request::post_html(),
				'question'               => \dash\request::post('question'),
				'resultpagetag'          => \dash\request::post('tag'),

			];


		if(\dash\request::files('file'))
		{
			$post['resultpageimage'] = \dash\upload\form::form($form_id);
		}

		$result = \lib\app\form\form\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}

}

?>