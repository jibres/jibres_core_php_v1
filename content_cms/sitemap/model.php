<?php
namespace content_cms\sitemap;

class model
{
	public static function post()
	{
		\dash\permission::access('cmsConfig');

		if(\dash\request::post('run') === 'yes')
		{
			$result = \dash\utility\sitemap::create_all();
			\dash\notif::ok(T_("Sitemap successfully created"));
			\dash\redirect::pwd();
			return;
		}


		if(\dash\request::post('remove') === 'remove')
		{
			\dash\utility\sitemap::delete();
			\dash\redirect::pwd();

		}

		if(\dash\request::post('rebuild') === 'rebuild')
		{
			\dash\utility\sitemap::delete();
			\dash\utility\sitemap::create_all();
			\dash\notif::ok(T_("Sitemap rebuild successfully"));
			\dash\redirect::pwd();
			return;


		}

	}
}
?>