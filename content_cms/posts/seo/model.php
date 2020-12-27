<?php
namespace content_cms\posts\seo;

class model
{
	public static function post()
	{

		$post =
		[
			'slug'     => \dash\request::post('slug'),
			'excerpt'  => \dash\request::post('excerpt'),
			'seotitle' => \dash\request::post('seotitle'),
			'tagurl'   => \dash\request::post('tagurl'),
			'parent'   => \dash\request::post('parent') ? \dash\request::post('parent') : null,
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
