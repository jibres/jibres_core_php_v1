<?php
namespace content_a\form\analytics\setting;


class model
{
	public static function post()
	{
		if(\dash\request::post('removefilter') === 'removefilter')
		{
			\lib\app\form\filter\remove::remove(\dash\request::get('fid'));
			\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
			return;
		}


		$post = \dash\request::post();
		\lib\app\form\filter\edit::fields(\dash\request::get('id'), $post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}


	}

}
?>
