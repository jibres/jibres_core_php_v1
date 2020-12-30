<?php
namespace content_cms\sitemap;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Sitemap'));

		\dash\data::back_text(T_('CMS'));
		\dash\data::back_link(\dash\url::here());


		$result = \dash\session::get('result_create_sitemap');

		\dash\data::sitemapData($result);

		if(is_dir(root. '/public_html/sitemap'))
		{
			\dash\data::siteMapFile_sitemap(true);
		}

		if(is_file(root. '/public_html/sitemap.xml'))
		{
			\dash\data::siteMapFile_base(true);
		}


	}
}
?>