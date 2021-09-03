<?php
namespace content_a\website\footer\template;

class model
{
	public static function post()
	{
		$post =
		[
			'footer'    => \dash\request::post('footer'),
		];

		$theme_detail = \lib\app\website\footer\set::set_footer_template($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that());
		}
	}
}
?>
