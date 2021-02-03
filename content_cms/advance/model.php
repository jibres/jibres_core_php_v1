<?php
namespace content_cms\advance;

class model
{
	public static function post()
	{
		$post = [];

		if(\dash\request::post('set_thumbratiostandard'))
		{
			$post['thumbratiostandard'] = \dash\request::post('thumbratiostandard');
		}

		if(\dash\request::post('set_thumbratiogallery'))
		{
			$post['thumbratiogallery'] = \dash\request::post('thumbratiogallery');
		}

		if(\dash\request::post('set_thumbratiovideo'))
		{
			$post['thumbratiovideo'] = \dash\request::post('thumbratiovideo');
		}

		if(\dash\request::post('set_thumbratiopodcast'))
		{
			$post['thumbratiopodcast'] = \dash\request::post('thumbratiopodcast');
		}

		if(\dash\request::post('set_defaultcomment'))
		{
			$post['defaultcomment'] = \dash\request::post('defaultcomment') ? 'open' : 'closed';
		}

		if(\dash\request::post('set_defaultshowwriter'))
		{
			$post['defaultshowwriter'] = \dash\request::post('defaultshowwriter') ? 'visible' : 'hidden';
		}

		if(\dash\request::post('set_defaultshowdate'))
		{
			$post['defaultshowdate'] = \dash\request::post('defaultshowdate') ? 'visible' : 'hidden';
		}

		if(empty($post))
		{
			\dash\notif::error(T_("Invalid request"));
			return false;
		}

		\lib\app\setting\set::cms_setting($post);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
			\dash\redirect::pwd();
		}

	}
}
?>