<?php
namespace content_a\website\body;

class model
{
	public static function post()
	{
		if(\dash\request::post('config_line_key') && \dash\request::post('config_line_type'))
		{
			$post =
			[
				'config_line_key'      => \dash\request::post('config_line_key'),
				'config_line_type'     => \dash\request::post('config_line_type'),
				'body_last_news_limit' => \dash\request::post('body_last_news_limit'),
			];

			$theme_detail = \lib\app\website\body\config::line($post);
		}
		elseif(\dash\request::post('removeline') === 'removeline')
		{
			$post =
			[
				'linekey'    => \dash\request::post('linekey'),
				'linetype'   => \dash\request::post('linetype'),
			];

			$theme_detail = \lib\app\website\body\set::remove_line($post);
		}


		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
