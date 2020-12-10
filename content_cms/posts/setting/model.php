<?php
namespace content_cms\posts\edit;

class model
{
	public static function post()
	{
		$posts = self::getPost();

		if(!$posts || !\dash\engine\process::status())
		{
			return false;
		}

		$post_detail = \dash\app\posts\edit::edit($posts, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}




	public static function getPost()
	{


		$post =
		[

			'subtitle'    => \dash\request::post('subtitle'),
			'excerpt'     => \dash\request::post('excerpt'),
			'title'       => \dash\request::post('title'),
			'tag'         => \dash\request::post('tag'),
			'slug'        => \dash\request::post('slug'),
			'content'     => \dash\request::post_raw('content'),
			'publishdate' => \dash\request::post('publishdate'),
			'publishtime' => \dash\request::post('publishtime'),
			'status'      => \dash\request::post('status'),
			'comment'     => \dash\request::post('comment'),
			'language'    => \dash\request::post('language') ? \dash\request::post('language') : \dash\language::current(),
			'parent'      => \dash\request::post('parent'),
			'special'     => \dash\request::post('special'),
			'creator'     => \dash\request::post('creator'),
			'seotitle'    => \dash\request::post('seotitle'),
			'subtype'     => \dash\request::post('subtype'),
			'btntitle'    => \dash\request::post('btntitle'),
			'btnurl'      => \dash\request::post_raw('btnurl'),
			'btntarget'   => \dash\request::post('btntarget'),
			'btncolor'    => \dash\request::post('btncolor'),
			'srctitle'    => \dash\request::post('srctitle'),
			'srcurl'      => \dash\request::post_raw('srcurl'),
			'redirecturl' => \dash\request::post_raw('redirecturl'),

		];


		if(\dash\request::post('icon'))
		{
			$post['icon'] = \dash\request::post('icon');
		}


		return $post;

	}
}
?>
