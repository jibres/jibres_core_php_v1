<?php
namespace content_a\website\footer;

class model
{
	public static function post()
	{
		$post =
		[
			'footer'    => \dash\request::post('footer'),
		];

		$theme_detail = \lib\app\website_footer\set::set_footer_template($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/footer/customize');
		}
	}
}
?>
