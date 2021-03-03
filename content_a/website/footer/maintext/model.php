<?php
namespace content_a\website\footer\maintext;

class model
{
	public static function post()
	{
		$post =
		[
			'text'   => \dash\request::post_raw('html'),

		];

		$customize_footer = \lib\app\website\footer\maintext::set($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
