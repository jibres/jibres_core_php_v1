<?php
namespace content_cms\posts\writer;

class model
{
	public static function post()
	{

		$post =
		[
			'creator'     => \dash\request::post('creator'),
		];


		if(!$post || !\dash\engine\process::status())
		{
			return false;
		}

		$post_detail = \dash\app\posts\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}

}
?>
