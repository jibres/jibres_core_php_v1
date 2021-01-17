<?php
namespace content_cms\customization\home;

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
			$post['defaultcomment'] = \dash\request::post('defaultcomment');
		}

		if(\dash\request::post('set_defaultshowwriter'))
		{
			$post['defaultshowwriter'] = \dash\request::post('defaultshowwriter');
		}

		if(\dash\request::post('set_defaultshowdate'))
		{
			$post['defaultshowdate'] = \dash\request::post('defaultshowdate');
		}

		\lib\app\setting\set::cms_setting($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>