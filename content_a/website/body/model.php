<?php
namespace content_a\website\body;

class model
{
	public static function post()
	{
		if(\dash\request::post('removeline') === 'removeline')
		{
			$post =
			[
				'linekey'    => \dash\request::post('linekey'),
				'linetype'   => \dash\request::post('linetype'),
			];

			$theme_detail = \lib\app\website_body\set::remove_line($post);
		}
		else
		{

			$post =
			[
				'line'    => \dash\request::post('line'),
			];

			$theme_detail = \lib\app\website_body\set::add_line($post);
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
